<?php
session_start();
require 'db.php';

// Define variables
$errorMessage = "";

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to prevent XSS attacks
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Validate input lengths (ensure minimum length requirements)
    if (strlen($username) < 4 || strlen($password) < 4) {
        $errorMessage = "Invalid input. Username and password must be at least 4 characters long.";
    } else {
        // Use a prepared statement to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Check if the user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            // Store username in session
            $_SESSION['user'] = $user['username'];

            // Redirect to the dashboard (read.php)
            header('Location: read.php');
            exit();
        } else {
            // Return a generic error message to avoid giving away details
            $errorMessage = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-dark">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="min-width: 300px;">
            <!-- <h3 class="text-center mb-4">FGL Member Manager</h3> -->
            <div class="text-center">
                <img src="./images/app_logo.png" alt="Image" class="img-thumbnail border border-0" width="150">
            </div>
            <div class="text-center">
                <h4>Team Manager</h4>
            </div>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?= htmlspecialchars($errorMessage) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> <!-- XSS protection: escape error message -->
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>