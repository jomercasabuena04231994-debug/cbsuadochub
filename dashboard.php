<?php
include('dbconnection.php');
session_start();


if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}


$result = mysqli_query($con, "SELECT COUNT(*) AS totalUsers FROM user_registration");
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['totalUsers'];

$result = mysqli_query($con, "SELECT COUNT(*) AS totalColleges FROM college");
$row = mysqli_fetch_assoc($result);
$totalColleges = $row['totalColleges'];

$result = mysqli_query($con, "SELECT COUNT(*) AS totalPrograms FROM programoffereing");
$row = mysqli_fetch_assoc($result);
$totalPrograms = $row['totalPrograms'];

$loggedInUser = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CBSUA QA DocHub Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen font-sans">

<!-- Sidebar -->
<aside class="w-64 bg-green-600 text-white flex flex-col fixed inset-y-0 z-20 shadow-lg">

  <!-- Logo/Header -->
  <div class="p-6 text-2xl font-bold text-center border-b border-green-500">
    CBSUA QA DocHub
  </div>

  <!-- User Welcome -->
  <div class="p-4 border-b border-green-500">
    <span class="text-white font-semibold">Welcome, <?php echo $loggedInUser; ?>!</span>
  </div>

  <!-- Navigation -->
  <nav class="flex-1 p-4 space-y-2">
    <a href="#" data-page="dashboard" class="flex items-center py-2 px-4 rounded bg-green-800 hover:bg-green-700">Dashboard</a>
    <a onclick="window.location.href='college.php'" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Colleges</a>
    <a onclick="window.location.href='prog_offering.php'" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Programs</a>
    <a onclick="window.location.href='accreditationviewdocs.php'" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Accreditation</a>
    <a onclick="window.location.href='users.php'" class="flex items-center py-2 px-4 rounded hover:bg-green-700">Users</a>
  </nav>

  <!-- Logout Button -->
  <div class="p-4 border-t border-green-500">
    <form action="logout.php" method="post">
      <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</button>
    </form>
  </div>

</aside>

<!-- Main Content -->
<main class="flex-1 ml-0 md:ml-64 p-6" id="mainContent">
  <div id="contentArea"></div>
</main>

<script>
const contentArea = document.getElementById('contentArea');

function showDashboard() {
  contentArea.innerHTML = `
    <!-- Dashboard Header -->
    

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 hover:shadow-xl transition">
        <div class="bg-green-100 p-4 rounded-full">
          <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a5 5 0 100-10 5 5 0 000 10z"/><path fill-rule="evenodd" d="M.458 18.042A9 9 0 0110 2a9 9 0 019.542 16.042A7 7 0 0010 18a7 7 0 00-9.542 0z" clip-rule="evenodd"/></svg>
        </div>
        <div>
          <p class="text-gray-500">Users</p>
          <p class="text-2xl font-bold"><?php echo $totalUsers; ?></p>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 hover:shadow-xl transition">
        <div class="bg-green-100 p-4 rounded-full">
          <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h3.586a1 1 0 01.707.293l1.414 1.414A1 1 0 0011.414 5H16a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/></svg>
        </div>
        <div>
          <p class="text-gray-500">Colleges</p>
          <p class="text-2xl font-bold"><?php echo $totalColleges; ?></p>
        </div>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-lg flex items-center space-x-4 hover:shadow-xl transition">
        <div class="bg-green-100 p-4 rounded-full">
          <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a1 1 0 000 2h12a1 1 0 100-2H4zM4 7a1 1 0 000 2h12a1 1 0 100-2H4zM4 11a1 1 0 000 2h12a1 1 0 100-2H4zM4 15a1 1 0 000 2h12a1 1 0 100-2H4z"/></svg>
        </div>
        <div>
          <p class="text-gray-500">Programs</p>
          <p class="text-2xl font-bold"><?php echo $totalPrograms; ?></p>
        </div>
      </div>
    </div>

    <!-- Image Section -->
    <div class="mt-6 flex justify-center">
      <img src="cbsua.jpg" alt="Dashboard Image" class="rounded-xl shadow-lg max-w-full h-auto">
    </div>
  `;
}


showDashboard();


document.querySelectorAll('aside nav a').forEach(link => {
  link.addEventListener('click', e => {
    const page = link.getAttribute('data-page');
    if (page === 'accreditation') return;
    e.preventDefault();
    showDashboard();
  });
});
</script>

</body>
</html>
