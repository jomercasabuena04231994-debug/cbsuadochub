<?php
include('dbconnection.php');

if (isset($_POST['submit'])) {

    // Sanitize inputs
    $area = mysqli_real_escape_string($con, $_POST['doc_area']);
    $title = mysqli_real_escape_string($con, $_POST['doc_title']);
    $type = mysqli_real_escape_string($con, $_POST['doc_type']);
    $uploadedBy = mysqli_real_escape_string($con, $_POST['docuploadedby']);

    // Generate timestamp in PHP
    $uploadedDate = date('Y-m-d H:i:s');

    // Handle file upload
    if (isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === 0) {
        $uploadDir = 'uploads/';
        $fileExt = strtolower(pathinfo($_FILES['doc_file']['name'], PATHINFO_EXTENSION));

        // Allowed file types
        $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        if (!in_array($fileExt, $allowed)) {
            echo "<script>alert('Invalid file type. Allowed: PDF, DOC, DOCX, JPG, PNG');</script>";
            exit;
        }

        // Create unique filename
        $fileName = uniqid('doc_', true) . '.' . $fileExt;
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $targetFile)) {

            // Prepared statement for insertion
            $stmt = $con->prepare("INSERT INTO qadocument (doc_area, doc_title, doc_type, docuploadedby, doc_timeupload, doc_file) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $area, $title, $type, $uploadedBy, $uploadedDate, $fileName);

            if ($stmt->execute()) {
                echo "<script>alert('Document successfully added'); window.location='area1addpage.php';</script>";
            } else {
                echo "<script>alert('Database insert error');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Failed to upload file');</script>";
        }
    } else {
        echo "<script>alert('No file selected');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Document - QA DocHub</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen p-6">

<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow">

  <h1 class="text-2xl font-bold mb-4">Add Document</h1>

  <form method="POST" enctype="multipart/form-data" class="space-y-5">

    <!-- Area -->
    <div>
      <label class="block mb-2 font-medium">Accreditation Area</label>
      <select name="doc_area" class="w-full border px-3 py-2 rounded" required>
        <option value="">Select Area</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </div>

    <!-- Title -->
    <div>
      <label class="block mb-2 font-medium">Title</label>
      <input type="text" name="doc_title" class="w-full border px-3 py-2 rounded" placeholder="Enter document title" required>
    </div>

    <!-- Type -->
    <div>
      <label class="block mb-2 font-medium">Type</label>
      <select name="doc_type" class="w-full border px-3 py-2 rounded" required>
        <option value="">Select type</option>
        <option>Policy</option>
        <option>Guideline</option>
        <option>Procedure</option>
        <option>Manual</option>
        <option>Others</option>
      </select>
    </div>

    <!-- Uploaded By -->
    <div>
      <label class="block mb-2 font-medium">Uploaded By</label>
      <input type="text" name="docuploadedby" class="w-full border px-3 py-2 rounded" placeholder="Enter uploader name" required>
    </div>

    <!-- File Upload -->
    <div>
      <label class="block mb-2 font-medium">Select File</label>
      <input type="file" name="doc_file" class="w-full border px-3 py-2 rounded" required>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end gap-3 pt-4">
      <a href="dashboard.php" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
      <button type="submit" name="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Add</button>
    </div>

  </form>

</div>

</body>
</html>
