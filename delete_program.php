<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if(!isset($_GET['id'])){ die("No program selected."); }
$id = intval($_GET['id']);

$query = "DELETE FROM programoffereing WHERE prog_id=$id";
if(mysqli_query($con, $query)){
    echo "<script>alert('Program deleted successfully!'); window.location.href='prog_offering.php';</script>";
} else { echo "Error: " . mysqli_error($con); }
?>
