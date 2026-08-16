<?php

setcookie("student_name", "", time() - 3600);
setcookie("student_id", "", time() - 3600);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Clear Cookie</title>
</head>
<body>

<h2>Cookie deleted successfully.</h2>

<a href="index.php">Back to Home</a>

</body>
</html>