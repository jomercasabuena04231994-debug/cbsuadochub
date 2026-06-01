<?php
$con = mysqli_connect("localhost", "root", "", "qadochub");
if(!$con){ die("Connection failed: ".mysqli_connect_error()); }

if(!isset($_GET['id'])) die("No user selected");
$id = intval($_GET['id']);
$res = mysqli_query($con, "SELECT * FROM user_registration WHERE user_id=$id");
$user = mysqli_fetch_assoc($res);
if(!$user) die("User not found");

if(isset($_POST['update'])){
    $last = mysqli_real_escape_string($con, $_POST['last_name']);
    $first = mysqli_real_escape_string($con, $_POST['first_name']);
    $middle = mysqli_real_escape_string($con, $_POST['middle_initial']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $dept = mysqli_real_escape_string($con, $_POST['department']);

    mysqli_query($con, "UPDATE user_registration SET last_name='$last', first_name='$first', middle_initial='$middle', role='$role', department='$dept' WHERE user_id=$id");

    echo "<script>alert('User updated successfully'); window.location='users.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update User</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
<h1 class="text-2xl font-bold mb-4">Update User</h1>
<form method="post">
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" class="border w-full mb-2 px-4 py-2 rounded" required>
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" class="border w-full mb-2 px-4 py-2 rounded" required>
    <input type="text" name="middle_initial" value="<?php echo htmlspecialchars($user['middle_initial']); ?>" class="border w-full mb-2 px-4 py-2 rounded" required>
    <input type="text" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" class="border w-full mb-2 px-4 py-2 rounded" required>
    <input type="text" name="department" value="<?php echo htmlspecialchars($user['department']); ?>" class="border w-full mb-2 px-4 py-2 rounded" required>
    <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
    <a href="users.php" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</form>
</div>
</body>
</html>
