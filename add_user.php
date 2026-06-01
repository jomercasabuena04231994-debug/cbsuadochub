<?php
$con = mysqli_connect("localhost", "root", "", "qadochub");
if(!$con){ die("Connection failed: ".mysqli_connect_error()); }

$error = ""; // For server-side error message

if(isset($_POST['submit'])){
    $last = mysqli_real_escape_string($con, trim($_POST['last_name']));
    $first = mysqli_real_escape_string($con, trim($_POST['first_name']));
    $middle = mysqli_real_escape_string($con, trim($_POST['middle_initial']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $username = mysqli_real_escape_string($con, trim($_POST['username']));
    $role = mysqli_real_escape_string($con, trim($_POST['role']));
    $dept = mysqli_real_escape_string($con, trim($_POST['department']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if($password !== $confirm_password){
        $error = "Passwords do not match"; 
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user_registration 
                (last_name, first_name, middle_initial, email_address, username, password, role, department) 
                VALUES ('$last','$first','$middle','$email','$username','$password_hashed','$role','$dept')";
        if(mysqli_query($con, $sql)){
            echo "<script>alert('User added successfully'); window.location='users.php';</script>";
            exit;
        } else {
            $error = "Error adding user: ".mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add User</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
<h1 class="text-2xl font-bold mb-4">Add User</h1>
<form method="post" id="addUserForm">

    <input type="text" name="last_name" placeholder="Last Name" required class="border w-full mb-2 px-4 py-2 rounded">
    <input type="text" name="first_name" placeholder="First Name" required class="border w-full mb-2 px-4 py-2 rounded">
    <input type="text" name="middle_initial" placeholder="Middle Initial" required class="border w-full mb-2 px-4 py-2 rounded">

    <input type="email" name="email" placeholder="Email" required class="border w-full mb-2 px-4 py-2 rounded">
    <input type="text" name="username" placeholder="Username" required class="border w-full mb-2 px-4 py-2 rounded">

    <!-- Inline password message -->
    <div id="passwordMessage" class="mb-2"></div>

    <input type="password" name="password" id="password" placeholder="Password" required class="border w-full mb-2 px-4 py-2 rounded">
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required class="border w-full mb-2 px-4 py-2 rounded">

    <input type="text" name="role" placeholder="Role" required class="border w-full mb-2 px-4 py-2 rounded">
    <input type="text" name="department" placeholder="Department" required class="border w-full mb-2 px-4 py-2 rounded">

    <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add User</button>
    <a href="users.php" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</form>
</div>

<script>
// Real-time password match check
const password = document.getElementById('password');
const confirm_password = document.getElementById('confirm_password');
const message = document.getElementById('passwordMessage');

function checkPasswords() {
    if(confirm_password.value === "") {
        message.textContent = "";
        return;
    }
    if(password.value === confirm_password.value){
        message.textContent = "Passwords match";
        message.className = "text-green-600 mb-2";
    } else {
        message.textContent = "Passwords do not match";
        message.className = "text-red-600 mb-2";
    }
}

password.addEventListener('input', checkPasswords);
confirm_password.addEventListener('input', checkPasswords);
</script>
</body>
</html>
