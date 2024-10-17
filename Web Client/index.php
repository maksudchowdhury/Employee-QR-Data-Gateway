<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Redirect to the read.php page where all the team members are listed
header('Location: read.php');
exit;
    