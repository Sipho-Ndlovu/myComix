<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyComix | Login & Signup</title>

    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/loginForm.css">
</head>
    <body>
        <section class="content">
            <div class="logo">

            </div>
            <div class ="forms">
                <div class="buttonContainer">
                    <button type="button" class="btnToggle" >Login</button>
                    <button type="button" class="btnToggle" >Signup</button>
                </div>
                <div class="formContainer"> 
                    <form class="loginForm" action="login.php" method="POST">
                        <span>Login</span>
                        <div class="inputContainer">
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <input type="submit" name="login" value="Login">
                    </form>
                    <form class="signupForm" action="login.php" method="POST">
                        <span>Signup</span>
                        <div class="inputContainer">
                            <input type="text" name="name" placeholder="Fullname">
                            <input type="text" name="email" placeholder="Email">
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <input type="password" name="confirmPassword" placeholder="Confirm Password">
                        </div>
                        <div class="submitContainer">
                            <input type="submit" name="signup" value="Signup">
                        </div>
                </div>
            </div>
    </section>
    </body>
</html>