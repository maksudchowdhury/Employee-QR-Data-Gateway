<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->query('SELECT * FROM team_info');
$team_info = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Add this inside the navbar or wherever you want the logout button to appear -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid p-5 pt-3 pb-0">
            <div class="text-center">
                <img src="./images/app_logo.png" alt="Image" class="img-thumbnail" width="50">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="read.php">Dashboard</a> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Main Content Area (Centered) -->
    <div class="mt-1 mr-5 ml-5 mb-0 pb-0">
        <h1 class="mb-4 text-center">Team Members</h1>

        <div class="p-5 pt-1 d-flex justify-content-start mb-0">
            <a href="create.php" class="btn btn-success">Add New Member</a>
        </div>

        <!-- Responsive Table -->
        <div class="card p-5 pt-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>

                            <th></th>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Job Status</th>
                            <th>Blood Group</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($team_info as $member): ?>
                            <tr>

                                <td><img src="<?= $member['image_path'] ?>" alt="Image" class="img-thumbnail" width="50"></td>
                                <td><?= $member['uid'] ?></td>
                                <td><?= $member['name'] ?></td>
                                <td><?= $member['department'] ?></td>
                                <td><?= $member['designation'] ?></td>
                                <td><?= $member['contact'] ?></td>
                                <td><?= $member['email'] ?></td>
                                <td><?= $member['job_status'] ?></td>
                                <td><?= $member['blood_group'] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $member['id'] ?>" class="btn btn-outline-light btn-sm">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                    <a href="delete.php?id=<?= $member['id'] ?>" class="btn btn-outline-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>