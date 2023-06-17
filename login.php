<?php
include 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform a database query to check if the email and password match
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        // User credentials are valid, redirect to the dashboard or homepage
        header('Location: homepage.php');
        exit();
    } else {
        // Invalid credentials, display an error message
        $error = 'Invalid Email or Password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Schedl</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #fb6f92;
        background-size: cover;
        background-position: center;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 7px 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
    }

    .error {
        color: red;
        text-align: center;
        font-weight: 700;
    }

    .logo {
        font-size: 25px;
        color: #fb6f92;
        text-decoration: none;
        font-weight: 700;
        pointer-events: none;
    }

    .navbar-date{
        font-weight: 500;
        font-size: 16px;
        font-weight: 600;
        text-align: right;
    }
    
    .wrapper {
        position: relative;
        top: 0;
        right: 0;
        width: 450px;
        height: 100%;
        background: transparent;
        z-index: 99;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
    }
    
    .wrapper .logreg-box {
        width: 100%;
    }

    .wrapper .form-box.login {
        display: block;
    }
    
    .logreg-box .logreg-title {
        text-align: center;
        margin-bottom: 40px;
        color: #fff;
    }

    .logreg-title h2 {
        font-size: 32px;
    }

    .logreg-title p {
        font-size: 14px;
        font-weight: 500;
    }

    .logreg-box .input-box {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;
        border-bottom: 2px solid #fff;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        padding-right: 25px;
    }

    .input-box label {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        pointer-events: none;
        transition: .5s;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
        top: -5px;
    }

    .input-box .icon {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        font-size: 19px;
        color: #fff;
    }

    .logreg-box .remember-forgot {
        font-size: 14.5px;
        color: #fff;
        font-weight: 500;
        margin: -15px 0 15px;
        display: flex;
        justify-content: space-between;
    }

    .remember-forgot label input {
        accent-color: #fff;
        margin-right: 3px;
    }

    .remember-forgot a {
        color: #fff;
        text-decoration: none;
    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }

    .logreg-box .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        cursor: pointer;
        font-size: 16px;
        color: #222;
        font-weight: 600;
    }

    .logreg-box .logreg-link {
        font-size: 14.5px;
        color: #fff;
        text-align: center;
        font-weight: 500;
        margin: 25px 0 15px;
    }

    .logreg-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .logreg-link p a:hover {
        text-decoration: underline;
    }

    .media-options {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .media-options a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 50px;
        background: transparent;
        border: 2px solid #fff;
        margin: 10px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
        border-radius: 40px;
        color: #fff;
        text-decoration: none;
        transition: .5s;
    }

    .media-options a:hover {
        background: rgba(255, 255, 255, .1);
    }

    .media-options a i {
        font-size: 22px;
        margin: 0 8px 1.5px 0;
    }
    
    .media-options a span {
        font-size: 16px;
        font-weight: 500;
    }

</style>

</head>

<body>
    
    <header class="header">
        <a href="#" class="logo">Schedl</a>

        <nav class="navbar">
            <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">Today's Date</p>
            <p class="navbar-date" style="padding: 0;margin: 0;">
                <?php 
            date_default_timezone_set('Asia/Kolkata');

            $today = date('Y-m-d');
            echo $today;

            ?>
            </p>
        </nav>
    </header>

   
        <div class="wrapper">
            <div class="logreg-box">

                <!-- login form -->
                <div class="form-box login">
                    <div class="logreg-title">
                        <h2>Login</h2>
                        <p>Please login to use the platform</p>

                        <?php if (isset($error)) : ?>
                        <p class="error"><?php echo $error; ?></p>
                        <?php endif; ?>

                    </div>

                    <form method="post" action="">
                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-envelope'></i></span>
                            <input type="email" name="email" required>
                            <label>Email</label>
                        </div>

                        <div class="input-box">
                            <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                            <input type="password" name="password" required>
                            <label>Password</label>
                        </div>

                        <div class="remember-forgot">
                            <label><input type="checkbox"> Remember me</label>
                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn">Login</button>

                        <div class="logreg-link">
                            <p>Don't have an account? 
                            <a href="signup.php" class="register-link">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="media-options">
                <a href="#">
                    <i class='bx bxl-google' ></i>
                    <span>Login with Google</span>
                </a>
                <a href="#">
                    <i class='bx bxl-facebook-circle' ></i>
                    <span>Login with Facebook</span>
                </a>
            </div>
        </div>

</body>

</html>
