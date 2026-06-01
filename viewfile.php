<?php
if(!isset($_GET['file'])){
    die("No file specified.");
}

$file = basename($_GET['file']);
$filepath = "uploads/" . $file;

if(!file_exists($filepath)){
    die("File not found.");
}

$ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

// Build absolute URL for Office viewer
$absoluteUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . 
               $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 
               "/uploads/" . $file;

// UNIVERSAL FILE HANDLER
switch($ext){

    /* ==========================
       PDF PREVIEW
    ========================== */
    case "pdf":
        header("Content-Type: application/pdf");
        readfile($filepath);
        break;

    /* ==========================
       IMAGE PREVIEW
    ========================== */
    case "jpg":
    case "jpeg":
    case "png":
    case "gif":
    case "bmp":
    case "webp":
        header("Content-Type: image/" . $ext);
        readfile($filepath);
        break;

    /* ==========================
       MICROSOFT OFFICE PREVIEW
       (Word, Excel, PowerPoint)
       Uses Microsoft Office Online Viewer
    ========================== */
    case "doc":
    case "docx":
    case "xls":
    case "xlsx":
    case "ppt":
    case "pptx":
        // Redirect to Office Viewer
        header("Location: https://view.officeapps.live.com/op/view.aspx?src=" . urlencode($absoluteUrl));
        exit;

    /* ==========================
       TEXT PREVIEW
    ========================== */
    case "txt":
    case "csv":
    case "html":
    case "css":
    case "js":
        header("Content-Type: text/plain");
        readfile($filepath);
        break;

    /* ==========================
       OTHER FILE TYPES
       (ZIP, RAR, EXE, APK, etc.)
       → automatic download
    ========================== */
    default:
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$file\"");
        readfile($filepath);
}

exit;
?>
