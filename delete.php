<?php
include('dbconnection.php');

if (!isset($_GET['id'])) {
    die("No document ID specified.");
}

$id = intval($_GET['id']);


$result = mysqli_query($con, "SELECT doc_file_name FROM qadocument WHERE id = $id");
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $file = "uploads/" . $row['doc_file_name'];
    

    if (file_exists($file)) {
        unlink($file);
    }
    

    mysqli_query($con, "DELETE FROM qadocument WHERE id = $id");
}

header("Location: documents.php");
exit;
?>
