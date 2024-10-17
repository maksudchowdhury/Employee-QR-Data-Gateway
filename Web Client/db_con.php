<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "fgl_team";
// $eid=$_GET['eid'];
// $query = "SELECT * FROM team_info where id='".$eid."'";
$eid = $_GET['eid'];
$query = "SELECT * FROM team_info where uid='" . $eid . "'";

$emp_id = "";
$emp_name = "";
$emp_department = "";
$emp_designation = "";
$emp_contact = "";
$emp_email = "";
$emp_job_status = "";
$emp_blood_group = "";
$emp_image_path = "";
$url = "team_error.php";


// Procedural Oriented Way
$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect)
    header('Location: ' . $url);

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) == 1) {
    while ($row = mysqli_fetch_assoc($result)) {

        $emp_id = $row['id'];
        $emp_name = $row['name'];
        $emp_department = $row['department'];
        $emp_designation = $row['designation'];
        $emp_contact = $row['contact'];
        $emp_email = $row['email'];
        $emp_job_status = $row['job_status'];
        $emp_blood_group = $row['blood_group'];
        $emp_image_path = $row['image_path'];
    }
} else {
    header('Location: ' . $url);
}


mysqli_close($connect);
