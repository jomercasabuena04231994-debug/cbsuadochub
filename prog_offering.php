<?php
$con = mysqli_connect("localhost","root","","qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }


$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($con, $_GET['search']);
}


$query = "SELECT * FROM programoffereing 
          WHERE prog_name LIKE '%$search%' OR prog_level LIKE '%$search%' 
          ORDER BY prog_name ASC";
$result = mysqli_query($con, $query);
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Program Offerings</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

<header class="bg-green-600 text-white p-4 shadow">
  <div class="max-w-6xl mx-auto flex justify-between items-center">
    <h1 class="text-2xl font-bold">PROGRAM OFFERINGS</h1>
    <button onclick="window.location.href='dashboard.php'" class="bg-green-700 px-4 py-2 rounded hover:bg-green-800">Back to Dashboard</button>
  </div>
</header>

<div class="max-w-6xl mx-auto p-6">

  <div class="mb-4 flex justify-between items-center">
    <button onclick="window.location.href='add_program.php'" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add New Program</button>
    <form method="GET" class="flex">
      <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Search programs..." class="px-3 py-2 border rounded-l">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-r hover:bg-green-700">Search</button>
    </form>
  </div>

  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4 text-green-600">List of Programs</h2>

    <table class="w-full table-auto border-collapse">
      <thead>
        <tr class="bg-green-100">
          <th class="border px-4 py-2 text-left">Program Name</th>
          <th class="border px-4 py-2 text-left">Program Level</th>
          <th class="border px-4 py-2 text-left">Actions</th>
        </tr>
      </thead>

      <tbody>
      <?php if(mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr class="odd:bg-white even:bg-green-50">
            <td class="border px-4 py-2"><?= htmlspecialchars($row['prog_name']); ?></td>
            <td class="border px-4 py-2"><?= htmlspecialchars($row['prog_level']); ?></td>
            <td class="border px-4 py-2 space-x-2">
              <button onclick="window.location.href='update_program.php?id=<?= $row['prog_id']; ?>'" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
              <button onclick="if(confirm('Delete this program?')) window.location.href='delete_program.php?id=<?= $row['prog_id']; ?>'" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center py-4">No programs found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>

  </div>
</div>
</body>
</html>
