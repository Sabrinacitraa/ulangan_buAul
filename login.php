<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <form action="proses_login.php" method="post">
        <div class="loginbox" id="login">
            <h1>Login</h1>
            <div class="txt_field">
                <input type="text" name="username">
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password">
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot Password?</div>
            <input type="submit" value="Login">
            <div class="signup_link">
                Not registered? <a href="signUp.php">Sign Up!</a>
            </div>
    </form>
    </div>
    </div>
</body>

</html>