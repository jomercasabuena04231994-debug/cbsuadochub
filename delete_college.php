<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if(!isset($_GET['id'])) die("No college selected.");
$id = intval($_GET['id']);

mysqli_query($con, "DELETE FROM College WHERE college_id=$id");
header("Location: college.php");
exit;
?>
