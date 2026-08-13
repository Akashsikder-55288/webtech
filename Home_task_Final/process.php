<?php

// Check whether form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid Request!");
}

// Receive form data using $_POST
$applicant_id = trim($_POST["applicant_id"]);
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$password = $_POST["password"];
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$job_position = isset($_POST["job_position"]) ? $_POST["job_position"] : "";
$qualification = trim($_POST["qualification"]);
$address = trim($_POST["address"]);

$errors = array();

// -------------------------
// Form Validation
// -------------------------

if ($applicant_id == "") {
    $errors[] = "Applicant ID is required.";
}

if ($name == "") {
    $errors[] = "Name is required.";
}

if ($email == "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if ($phone == "") {
    $errors[] = "Phone number is required.";
} elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
    $errors[] = "Phone number must contain exactly 11 digits.";
}

if ($password == "") {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors[] = "Password must contain at least 6 characters.";
}

if ($gender == "") {
    $errors[] = "Please select your gender.";
}

if ($job_position == "") {
    $errors[] = "Please select a job position.";
}

if ($qualification == "") {
    $errors[] = "Qualification is required.";
}

if ($address == "") {
    $errors[] = "Address is required.";
}

// -------------------------
// CV Validation using $_FILES
// -------------------------

if (!isset($_FILES["cv"]) || $_FILES["cv"]["error"] == UPLOAD_ERR_NO_FILE) {

    $errors[] = "Please upload your CV.";

} else {

    $file_name = $_FILES["cv"]["name"];
    $file_size = $_FILES["cv"]["size"];
    $file_tmp = $_FILES["cv"]["tmp_name"];

    // Get file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Allowed extensions
    $allowed_extensions = array("pdf", "doc", "docx");

    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "Only PDF, DOC, and DOCX files are allowed.";
    }

    // Maximum size = 2 MB
    if ($file_size > 2 * 1024 * 1024) {
        $errors[] = "CV file size must not exceed 2 MB.";
    }
}

// -------------------------
// Display errors
// -------------------------

if (count($errors) > 0) {

    echo "<h1>Application Failed!</h1>";

    echo "<ul>";

    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }

    echo "</ul>";

    echo '<a href="index.php">Go Back</a>';

    exit();
}

// -------------------------
// Upload CV
// -------------------------

$upload_folder = "uploads/";

if (!is_dir($upload_folder)) {
    mkdir($upload_folder, 0777, true);
}

// Create unique filename
$new_file_name = time() . "_" . basename($file_name);

$destination = $upload_folder . $new_file_name;

if (!move_uploaded_file($file_tmp, $destination)) {
    die("Error uploading CV.");
}

// -------------------------
// Send information to result.php
// using GET parameters
// -------------------------

$url = "result.php?";
$url .= "id=" . urlencode($applicant_id);
$url .= "&name=" . urlencode($name);
$url .= "&cv=" . urlencode($new_file_name);

header("Location: " . $url);
exit();

?>