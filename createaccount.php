<?php
include('dbconnection.php');
if (isset($_POST['submit']))
{
    $lastName=$_POST['lastName'];
    $firstName=$_POST['firstName'];
    $middleInitial=$_POST['middleInitial'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $department=$_POST['department'];
    
    $query=mysqli_query($con, "Insert into user_registration (last_name, first_name, middle_initial, email_address, username, password, role, department) Values ('$lastName', '$firstName', '$middleInitial', '$email','$username', '$password', '$role', '$department')");
    if ($query) {

        echo "<script>alert('data inserted successfully')</script>";
        }
        else{
           echo "<script>alert('there is an error')</script>";
        }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f2e6; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .form-container h2 {
            color: #339933;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #004d00;
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            box-sizing: border-box;
            font-size: 1em;
        }

        .name-fields {
            display: flex;
            gap: 10px;
        }

        .name-fields input {
            flex: 1;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .form-container button {
            background-color: #33cc33;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
            flex: 1;
        }

        .form-container button:hover {
            background-color: #267326;
        }

        .cancel-button {
            background-color: #ff4d4d;
        }

        .cancel-button:hover {
            background-color: #cc0000;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #339933;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>User Registration</h2>
        <form id="registrationForm" method="POST" action="">
            <label>Full Name</label>
            <div class="name-fields">
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                <input type="text" id="middleInitial" name="middleInitial" placeholder="M.I." maxlength="1" required>
            </div>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="">Select role</option>
                <option value="ISO Auditor">ISO Auditor</option>
                <option value="Accreditor">Accreditor</option>
                <option value="Employee/Staff">Employee/Staff</option>
            </select>

            <label for="department">Department/Unit</label>
            <input type="text" id="department" name="department" placeholder="Enter department/unit" required>

            <!-- Hidden timestamp field -->
            <input type="hidden" id="dateRegistered" name="dateRegistered">

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" name="submit">Register</button>
               
            </div>
        </form>

        <!-- Login link -->
        <div class="login-link">
            Already have an account? <a href="loginform.php">Login here</a>
        </div>
    </div>

    <script>
        // Automatically set timestamp when submitting the form
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const timestamp = new Date().toISOString();
            document.getElementById('dateRegistered').value = timestamp;
        });
    </script>
</body>
</html>
