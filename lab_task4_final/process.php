<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_name = $_POST["student_name"];
    $student_id = $_POST["student_id"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($student_name)) {
        $errors[] = "Student Name is required.";
    } elseif (!preg_match("/^[A-Za-z ]+$/", $student_name)) {
        $errors[] = "Student Name should contain only letters and spaces.";
    }

    if (empty($student_id)) {
        $errors[] = "Student ID is required.";
    } elseif (strlen($student_id) < 4) {
        $errors[] = "Student ID must contain at least 4 characters.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($department)) {
        $errors[] = "Please select a department.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must contain at least 6 characters.";
    }

    if (empty($confirm_password)) {
        $errors[] = "Please confirm your password.";
    } elseif ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (count($errors) == 0) {

        setcookie("student_name", $student_name, time() + 3600);
        setcookie("student_id", $student_id, time() + 3600);

    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Result</title>
</head>
<body>

<h2>Registration Result</h2>

<?php

if (count($errors) > 0) {

    echo "<h3>Validation Failed!</h3>";

    foreach ($errors as $error) {

        echo "<p>$error</p>";

    }

} else {

    echo "<h3>Registration Successful!</h3>";
    echo "<p>Student Name: " . $student_name . "</p>";
    echo "<p>Student ID: " . $student_id . "</p>";
    echo "<p>Cookies have been saved for 1 hour.</p>";

}

?>

<br>
<a href="index.php">Back to Home</a>

</body>
</html>