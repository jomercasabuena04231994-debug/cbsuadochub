<?php
include('dbconnection.php');

if(!isset($_GET['id'])){
    die("No document selected.");
}

$id = intval($_GET['id']);

// Fetch document
$stmt = $con->prepare("SELECT * FROM qadocument WHERE doc_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$doc = $result->fetch_assoc();
$stmt->close();

if(!$doc) die("Document not found.");

// Update document
if(isset($_POST['update'])){
    $area = mysqli_real_escape_string($con, $_POST['doc_area']);
    $title = mysqli_real_escape_string($con, $_POST['doc_title']);
    $type = mysqli_real_escape_string($con, $_POST['doc_type']);
    $uploadedby = mysqli_real_escape_string($con, $_POST['docuploadedby']);
    $timeupload = mysqli_real_escape_string($con, $_POST['doc_timeupload']);
    $file_name = $doc['doc_file']; // default existing file

    // Handle file upload
    if(isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === 0){
        $uploadDir = 'uploads/';
        $fileExt = strtolower(pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION));

        // Allowed file types
        $allowed = ['pdf','doc','docx','jpg','jpeg','png'];
        if(!in_array($fileExt, $allowed)){
            echo "<script>alert('Invalid file type. Allowed: PDF, DOC, DOCX, JPG, PNG');</script>";
            exit;
        }

        // Unique filename
        $newFileName = uniqid('doc_', true) . '.' . $fileExt;
        $targetFile = $uploadDir . $newFileName;

        if(move_uploaded_file($_FILES['doc_file']['tmp_name'], $targetFile)){
            // Delete old file
            if(file_exists($uploadDir . $doc['doc_file'])){
                unlink($uploadDir . $doc['doc_file']);
            }
            $file_name = $newFileName;
        }
    }

    // Prepared statement for update
    $stmt = $con->prepare("UPDATE qadocument SET doc_area=?, doc_title=?, doc_type=?, docuploadedby=?, doc_timeupload=?, doc_file=? WHERE doc_id=?");
    $stmt->bind_param("ssssssi", $area, $title, $type, $uploadedby, $timeupload, $file_name, $id);

    if($stmt->execute()){
        $stmt->close();
        header("Location: area4.php");
        exit;
    } else {
        echo "<script>alert('Failed to update document');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Document</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen p-6">

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow">
  <h1 class="text-2xl font-bold mb-4">Edit Document</h1>

  <form method="POST" enctype="multipart/form-data">

    <!-- Area -->
    <label class="block mb-2 font-medium">Accreditation Area</label>
    <select name="doc_area" class="w-full border px-3 py-2 mb-4 rounded" required>
      <option value="">Select Area</option>
      <?php
      for($i=1;$i<=10;$i++){
          $areaName = "$i";
          $selected = ($doc['doc_area'] == $areaName) ? "selected" : "";
          echo "<option value='$areaName' $selected>$areaName</option>";
      }
      ?>
    </select>

    <!-- Title -->
    <label class="block mb-2 font-medium">Title</label>
    <input type="text" name="doc_title" value="<?= htmlspecialchars($doc['doc_title']) ?>" class="w-full border px-3 py-2 mb-4 rounded" required>

    <!-- Type -->
    <label class="block mb-2 font-medium">Type</label>
    <input type="text" name="doc_type" value="<?= htmlspecialchars($doc['doc_type']) ?>" class="w-full border px-3 py-2 mb-4 rounded" required>

    <!-- Uploaded By -->
    <label class="block mb-2 font-medium">Uploaded By</label>
    <input type="text" name="docuploadedby" value="<?= htmlspecialchars($doc['docuploadedby']) ?>" class="w-full border px-3 py-2 mb-4 rounded" required>

    <!-- Timestamp -->
    <label class="block mb-2 font-medium">Uploaded Date/Time</label>
    <input type="datetime-local" name="doc_timeupload" value="<?= date('Y-m-d\TH:i', strtotime($doc['doc_timeupload'])) ?>" class="w-full border px-3 py-2 mb-4 rounded" required>

    <!-- File -->
    <label class="block mb-2 font-medium">File (leave blank to keep existing file)</label>
    <input type="file" name="doc_file" class="w-full border px-3 py-2 mb-4 rounded">
    <p class="mb-4 text-gray-600">Current File: <strong><?= htmlspecialchars($doc['doc_file']) ?></strong></p>

    <!-- Buttons -->
    <button type="submit" name="update" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update</button>
    <a href="area4.php" class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</a>

  </form>
</div>

</body>
</html>
