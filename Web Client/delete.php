<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

// Fetch the team member's details for confirmation
$stmt = $pdo->prepare('SELECT * FROM team_info WHERE id = ?');
$stmt->execute([$id]);
$member = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete the image file if it exists
    if (file_exists($member['image_path'])) {
        unlink($member['image_path']);  // Delete the image file
    }

    // Delete the team member from the database
    $stmt = $pdo->prepare('DELETE FROM team_info WHERE id = ?');
    $stmt->execute([$id]);

    // Redirect to the read page after deletion
    header('Location: read.php');
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Team Member</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Add this inside the navbar or wherever you want the logout button to appear -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="text-center">
                <img src="./images/app_logo.png" alt="Image" class="img-thumbnail" width="50">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="read.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mt-4">Are you sure you want to delete this member?</h1>

        <div class="text-center">
            <img src="<?= $member['image_path'] ?>" alt="Image" class="img-thumbnail" width="150">
        </div>

        <div class="card p-4">
            <p><strong>Name:</strong> <?= $member['name'] ?></p>
            <p><strong>Designation:</strong> <?= $member['designation'] ?></p>

            <!-- Confirmation form -->
            <form action="delete.php?id=<?= $id ?>" method="post">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a href="read.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>