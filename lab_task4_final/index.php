<?php

if (isset($_COOKIE["student_name"]) && isset($_COOKIE["student_id"])) {
    echo "<h3>Welcome Back!</h3>";
    echo "<p>Student Name: " . $_COOKIE["student_name"] . "</p>";
    echo "<p>Student ID: " . $_COOKIE["student_id"] . "</p>";
} else {
    echo "<p>No saved student information found.</p>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
</head>
<body>

<h2>Student Registration Form</h2>

<form action="process.php" method="POST">

    <label>Student Name:</label>
    <input type="text" name="student_name">
    <br><br>

    <label>Student ID:</label>
    <input type="text" name="student_id">
    <br><br>

    <label>Email:</label>
    <input type="text" name="email">
    <br><br>

    <label>Department:</label>

    <select name="department">

        <option value="">Select Department</option>

        <option value="CSE">CSE</option>
        <option value="EEE">EEE</option>
        <option value="BBA">BBA</option>
        <option value="English">English</option>

    </select>

    <br><br>

    <label>Password:</label>
    <input type="password" name="password">
    <br><br>

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password">
    <br><br>

    <input type="submit" value="Submit">

</form>

<form action="clear.php" method="POST">
    <input type="submit" value="Clear Cookie">
</form>

</body>
</html>
(Index.php)