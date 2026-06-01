<?php
include('dbconnection.php');
$id = intval($_GET['id']);
$result = mysqli_query($con, "SELECT doc_file, doc_file_name FROM qadocument WHERE id=$id");
if($row = mysqli_fetch_assoc($result)){
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$row['doc_file_name'].'"');
    echo $row['doc_file'];
    exit;
}else{
    echo "File not found.";
}
?>
