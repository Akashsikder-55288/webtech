<?php

// Retrieve values using $_GET
$applicant_id = isset($_GET["id"]) ? $_GET["id"] : "";
$name = isset($_GET["name"]) ? $_GET["name"] : "";
$cv = isset($_GET["cv"]) ? $_GET["cv"] : "";

// Retrieve at least two values using $_REQUEST
$request_id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
$request_name = isset($_REQUEST["name"]) ? $_REQUEST["name"] : "";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Successful</title>
</head>
<body>

    <h1>=================================</h1>
    <h1>APPLICATION SUCCESSFUL</h1>
    <h1>=================================</h1>

    <p>
        <strong>Applicant ID:</strong>
        <?php echo htmlspecialchars($applicant_id); ?>
    </p>

    <p>
        <strong>Name:</strong>
        <?php echo htmlspecialchars($name); ?>
    </p>

    <p>
        <strong>Applicant ID using REQUEST:</strong>
        <?php echo htmlspecialchars($request_id); ?>
    </p>

    <p>
        <strong>Name using REQUEST:</strong>
        <?php echo htmlspecialchars($request_name); ?>
    </p>

    <p>
        <strong>Uploaded CV:</strong>
        <?php echo htmlspecialchars($cv); ?>
    </p>

    <p>Application submitted successfully.</p>

    <a href="uploads/<?php echo urlencode($cv); ?>" target="_blank">
        View Uploaded CV
    </a>

</body>
</html>