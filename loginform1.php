<?php
include('dbconnection.php');
session_start();

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];  // FIXED

    // PREPARED STATEMENT (prevents SQL injection)
    $stmt = $con->prepare("SELECT * FROM user_registration WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // CHECK IF USER EXISTS
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // CHECK PASSWORD (plain or hashed)
        if (password_verify($password, $row['password']) || $password === $row['password']) {

            // LOGIN SUCCESS
            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['id'];

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }

    } else {
        echo "<script>alert('Username not found');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
        }

        /* LEFT SIDE - LOGO */
        .left-side {
            flex: 1;
            background: #e6f2e6; /* light green background */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left-side img {
            width: 240px;
            height: auto;
            margin-bottom: 15px;
        }

        .left-side .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #339933; /* green text */
        }

        /* RIGHT SIDE - LOGIN FORM */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
        }

        .login-box {
            width: 80%;
            max-width: 350px;
            padding: 30px;
            border-radius: 24px; /* soft edges */
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 18px;
            font-size: 22px;
            color: #339933; /* green heading */
        }

        .login-box .welcome-text {
            text-align: center;
            margin-bottom: 12px;
            font-size: 15px;
            color: #444;
        }

        label {
            font-weight: bold;
            font-size: 14px;
            color: #267326; /* dark green labels */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 6px 0 14px;
            border-radius: 12px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 11px;
            background: #339933; /* green button */
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.2s ease-in-out;
        }

        button:hover {
            background: #267326; /* darker green */
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .pre-register {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #267326;
        }

        .pre-register a {
            text-decoration: none;
            font-weight: bold;
            color: #339933;
        }

        .pre-register a:hover {
            text-decoration: underline;
        }

        @media(max-width: 768px) {
            body {
                flex-direction: column;
            }
            .left-side, .right-side {
                flex: unset;
                width: 100%;
                height: 50vh;
            }
        }
    </style>
</head>
<body>

    <!-- LEFT SIDE - LOGO -->
    <div class="left-side">
        <img src="CBSUA_Logo.png" alt="School Logo">
        <div class="logo-text">CBSUA QA DocHub</div>
    </div>

    <!-- RIGHT SIDE - LOGIN FORM -->
    <div class="right-side">
        <div class="login-box">
            <h2>WELCOME</h2>
            

            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>

                <button type="submit" name="submit">Login</button>
            </form>

            <div class="pre-register">
         
         <div class="pre-register">
            Don't have an account? <a href="createaccount.php">Pre-register</a>
         </div>

</div>
        </div>
    </div>

</body>
</html>
