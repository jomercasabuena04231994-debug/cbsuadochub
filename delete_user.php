<?php
$con = mysqli_connect("localhost", "root", "", "qadochub");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("No user selected");
}

$id = intval($_GET['id']);

// Use prepared statement for safety
$stmt = $con->prepare("DELETE FROM user_registration WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$con->close();

// Redirect back to users page
header("Location: users.php");
exit;
?>
