<?php
include('dbconnection.php');

if(isset($_GET['file'])){
    $file = basename($_GET['file']); // sanitize file name
    $filepath = 'uploads/' . $file; // assuming files are stored in "uploads/" folder

    if(file_exists($filepath)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
