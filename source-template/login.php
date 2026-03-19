<?php 
require_once "importance.php"; 

if(User::loggedIn()){
    Config::redir("index.php"); 
}
?> 

<html>
<head>
    <title>LOGIN - <?php echo CONFIG::SYSTEM_NAME; ?></title>
    <?php require_once "inc/head.inc.php"; ?> 

    <style>
        /* general body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9ff; /* light blue background */
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-card h2 {
            color: #0d6efd; /* primary blue color */
            margin-bottom: 10px;
        }

        .login-card p {
            color: #555555;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-holder input[type="text"],
        .form-holder input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 14px;
        }

        .form-holder button {
            width: 100%;
            padding: 12px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-holder button:hover {
            background-color: #0b5ed7;
        }

        .role-selection {
            margin-top: 20px;
        }

        .role-selection a {
            display: inline-block;
            margin: 10px;
            padding: 10px 25px;
            background-color: #e7f1ff;
            color: #0d6efd;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .role-selection a:hover {
            background-color: #0d6efd;
            color: white;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">

            <?php 
                if(isset($_GET['attempt'])){
                    $status = $_GET['attempt'];
                    $header = ($status == 1) ? "Login as Admin" : "Login as Doctor";
                    echo "<h2>$header</h2>";
                    echo "<p>Enter your credentials to access the system</p>";

                    if(isset($_POST['login-email'])){
                        $email = $_POST['login-email']; 
                        $password = $_POST['login-password'];

                        if($email == "" || $password == ""){
                            echo "<div class='error-message'>You must fill in all the fields</div>";
                        } else {
                            User::login($email, $password, $status);
                        }
                    }
            ?>

            <div class="form-holder">
                <?php Db::form(array("Email", "Password"), 3, array("login-email", "login-password"), array("text", "password"), "Login"); ?> 
            </div>

            <?php 
                } else {
            ?>

            <h2>Login As</h2>
            <p>Select your role to continue</p>

            <div class="role-selection">
                <a href='login.php?attempt=1'>Admin</a>
                <a href='login.php?attempt=2'>Doctor</a>
                <a href='login-patient.php'>Patient</a>
            </div>

            <?php } ?>

        </div>
    </div>

</body>
</html>