<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if(isset($_POST['submit'])){
    $college_name = mysqli_real_escape_string($con, $_POST['college_name']);

    $query = "INSERT INTO College (college_name) VALUES ('$college_name')";
    if(mysqli_query($con, $query)){
        echo "<script>alert('College added successfully!'); window.location.href='add_college.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add College</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-green-600">Add New College</h1>
        <button type="button" onclick="window.location.href='college.php'" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Back</button>
    </div>

    <form method="POST" action="">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">College Name</label>
            <input type="text" name="college_name" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex space-x-2">
            <button type="submit" name="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add College</button>
            <button type="reset" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Clear</button>
        </div>
    </form>
</div>
</body>
</html>
