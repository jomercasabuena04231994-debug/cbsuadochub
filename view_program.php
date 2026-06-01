<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if(!isset($_GET['id'])){ die("No program selected."); }
$id = intval($_GET['id']);

$result = mysqli_query($con, "SELECT * FROM prog_offereing WHERE prog_id=$id");
$program = mysqli_fetch_assoc($result);
if(!$program) die("Program not found.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Program</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">
    <h1 class="text-2xl font-bold text-green-600 mb-4">Program Details</h1>

    <div class="mb-4">
        <strong>College:</strong>
        <p class="border p-2 rounded bg-green-50"><?= $program['prog_college']; ?></p>
    </div>

    <div class="mb-4">
        <strong>Program Name:</strong>
        <p class="border p-2 rounded bg-green-50"><?= $program['prog_name']; ?></p>
    </div>

    <div class="mb-4">
        <strong>Program Level:</strong>
        <p class="border p-2 rounded bg-green-50"><?= $program['prog_level']; ?></p>
    </div>

    <button onclick="window.location.href='programs.php'" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Back to Programs</button>
</div>

</body>
</html>
