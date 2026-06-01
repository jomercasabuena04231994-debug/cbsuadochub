<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

// Fetch all colleges from College table
$collegeQuery = "SELECT college_name FROM College ORDER BY college_name ASC";
$collegeResult = mysqli_query($con, $collegeQuery);

if(isset($_POST['submit'])){
    $prog_college = mysqli_real_escape_string($con, $_POST['prog_college']);
    $prog_name    = mysqli_real_escape_string($con, $_POST['prog_name']);
    $prog_level   = mysqli_real_escape_string($con, $_POST['prog_level']);

    $query = "INSERT INTO programoffereing (prog_college, prog_name, prog_level) VALUES ('$prog_college', '$prog_name', '$prog_level')";
    if(mysqli_query($con, $query)){
        echo "<script>alert('Program added successfully!'); window.location.href='add_program.php';</script>";
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
<title>Add New Program</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<div class="max-w-3xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-green-600">Add New Program</h1>
        <button type="button" onclick="window.location.href='prog_offering.php'" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
            Back
        </button>
    </div>

    <form method="POST" action="">
        <div class="mb-4">
            <label class="block mb-1 font-semibold">College</label>
            <select name="prog_college" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Select College --</option>
                <?php while($row = mysqli_fetch_assoc($collegeResult)): ?>
                    <option value="<?= htmlspecialchars($row['college_name']); ?>"><?= htmlspecialchars($row['college_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Program Name</label>
            <input type="text" name="prog_name" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Program Level</label>
            <input type="text" name="prog_level" required class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex space-x-2">
            <button type="submit" name="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Program</button>
            <button type="reset" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Clear</button>
        </div>
    </form>
</div>

</body>
</html>
