<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$errorMessage = ""; // To hold any error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = htmlspecialchars(trim($_POST['uid']));
    $name = htmlspecialchars(trim($_POST['name']));
    $department = htmlspecialchars(trim($_POST['department']));
    $designation = htmlspecialchars(trim($_POST['designation']));
    $contact = htmlspecialchars(trim($_POST['contact']));
    $email = htmlspecialchars(trim($_POST['email']));
    $job_status = htmlspecialchars(trim($_POST['job_status']));
    $blood_group = htmlspecialchars(trim($_POST['blood_group']));

    // Check if UID already exists
    $stmt = $pdo->prepare("SELECT * FROM team_info WHERE uid = ?");
    $stmt->execute([$uid]);
    $existingEntry = $stmt->fetch();

    if ($existingEntry) {
        $errorMessage = "UID already exists. Please change the UID or <a href='update.php?id={$existingEntry['id']}'>edit the existing entry</a>.";
    } else {
        // Handle file upload
        $image_path = '';
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
            $file = $_FILES['image_path'];
            $fileSize = $file['size'];
            $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);

            // Validate file type and size
            $allowedTypes = ['jpg', 'jpeg', 'png'];
            if (in_array(strtolower($fileType), $allowedTypes) && $fileSize <= 2 * 1024 * 1024) { // 2MB limit
                // Rename the file
                $newFileName = $uid . '.' . $fileType;
                $targetDir = 'uploads/';
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    // Crop the image to 1:1 aspect ratio
                    $croppedImagePath = cropImage($targetFile, $fileType);
                    if ($croppedImagePath) {
                        $image_path = $croppedImagePath;
                    } else {
                        echo "Error cropping the image.";
                    }
                } else {
                    echo "Error uploading the file.";
                }
            } else {
                echo "Invalid file type or size. Please upload PNG, JPG, or JPEG images not exceeding 2MB.";
            }
        }

        // Insert new member into the database
        if ($image_path) {
            $stmt = $pdo->prepare("INSERT INTO team_info (uid, name, department, designation, contact, email, job_status, blood_group, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$uid, $name, $department, $designation, $contact, $email, $job_status, $blood_group, $image_path]);

            // Set success message and redirect
            $_SESSION['success_message'] = "Team member created successfully!";
            // echo "<script>setTimeout(function(){ window.location.href = 'read.php'; }, 1500);</script>";
        } else {
            // Handle case where the image upload failed
            echo "Member created without an image.";
        }
    }
}

// Function to crop the image to 1:1 aspect ratio
function cropImage($filePath, $fileType)
{
    // Load the image
    switch ($fileType) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($filePath);
            break;
        case 'png':
            $image = imagecreatefrompng($filePath);
            break;
        default:
            return false;
    }

    // Get the dimensions of the image
    $width = imagesx($image);
    $height = imagesy($image);

    // Determine the size of the crop
    $size = min($width, $height);
    $x = ($width - $size) / 2;  // Calculate x offset
    $y = ($height - $size) / 2; // Calculate y offset

    // Create a new square image
    $croppedImage = imagecreatetruecolor($size, $size);
    imagecopyresampled($croppedImage, $image, 0, 0, $x, $y, $size, $size, $size, $size);

    // Save the cropped image
    $croppedFilePath = $filePath; // Overwrite the original file or you can change the name
    imagejpeg($croppedImage, $croppedFilePath, 90); // Save as JPEG with 90 quality

    // Free up memory
    imagedestroy($image);
    imagedestroy($croppedImage);

    return $croppedFilePath; // Return the path of the cropped image
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team Member</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Add a new member</h1>

        <?php if ($errorMessage): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $errorMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card p-4 shadow-sm">
            <form action="create.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- UID -->


                    <label for="uid" class="form-label">UID</label>
                    <div class="input-group col-md-6 mb-3">
                        <!-- <span class="input-group-text" id="basic-addon1">fgl</span> -->
                        <input type="text" name="uid" id="uid" class="form-control" placeholder="Enter ID Number Only" required>
                    </div>


                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                    </div>

                    <!-- Department -->
                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" name="department" id="department" class="form-control" placeholder="Enter Department" required>
                    </div>

                    <!-- Designation -->
                    <div class="col-md-6 mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" placeholder="Enter Designation" required>
                    </div>

                    <!-- Contact -->
                    <div class="col-md-6 mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Contact" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>

                    <!-- Job Status -->
                    <div class="col-md-6 mb-3">
                        <label for="job_status" class="form-label">Job Status</label>
                        <select name="job_status" id="job_status" class="form-select" required>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>

                    <!-- Blood Group -->
                    <div class="col-md-6 mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select type="text" name="blood_group" id="blood_group" class="form-control" placeholder="Enter Blood Group" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-12 mb-3">
                        <label for="image_path" class="form-label">Image Upload (PNG, JPG, JPEG, max 2MB)</label>
                        <input type="file" name="image_path" id="image_path" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Create Member</button>
            </form>
        </div>
    </div>

    <!-- Success Notification Modal -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <!-- <div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" style="display:block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div> -->


        <div class="modal fade show" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display:block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Successfully Added</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Close modal after 1.5 seconds and redirect to read.php
            setTimeout(function() {
                document.getElementById('successModal').style.display = 'none';

            }, 4000);
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
</body>

</html>