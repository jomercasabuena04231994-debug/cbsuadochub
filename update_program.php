<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if(!isset($_GET['id'])){ die("No program selected."); }
$id = intval($_GET['id']);


$result = mysqli_query($con, "SELECT * FROM programoffereing WHERE prog_id=$id");
$program = mysqli_fetch_assoc($result);
if(!$program) die("Program not found.");

if(isset($_POST['update'])){
    $prog_college = mysqli_real_escape_string($con, $_POST['prog_college']);
    $prog_name    = mysqli_real_escape_string($con, $_POST['prog_name']);
    $prog_level   = mysqli_real_escape_string($con, $_POST['prog_level']);

    $query = "UPDATE programoffereing SET prog_college='$prog_college', prog_name='$prog_name', prog_level='$prog_level' WHERE prog_id=$id";
    if(mysqli_query($con, $query)){
        echo "<script>alert('Program updated successfully!'); window.location.href='prog_offering.php';</script>";
    } else { echo "Error: " . mysqli_error($con); }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Program</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">
    <h1 class="text-2xl font-bold text-green-600 mb-4">Edit Program</h1>

    <form method="POST" action="">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">College</label>
            <input type="text" name="prog_college" value="<?= $program['prog_college']; ?>" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Program Name</label>
            <input type="text" name="prog_name" value="<?= $program['prog_name']; ?>" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Program Level</label>
            <input type="text" name="prog_level" value="<?= $program['prog_level']; ?>" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex space-x-2">
            <button type="submit" name="update" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update Program</button>
            <button type="button" onclick="window.location.href='prog_offering.php'" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
        </div>
    </form>
</div>

</body>
</html>
