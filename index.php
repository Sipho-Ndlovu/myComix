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
        <div class="forms">
            <div class="buttonContainer">
                <button type="button" class="btnToggle btnLogin">Login</button>
                <button type="button" class="btnToggle btnSignup">Signup</button>
            </div>
            <div class="formContainer">
                <form class="loginForm" id="loginForm" method="POST">
                    <span>Login</span>
                    <div class="inputContainer">
                        <input type="hidden" name="submit_type" value="login">
                        <input type="text" name="username" id="loginUsername" placeholder="Username">
                        <input type="password" name="password" id="loginPassword" placeholder="Password">
                        <span class=messageContainer></span>
                    </div>
                    <div class="submitContainer">
                        <input type="submit" name="login" id="loginSubmit" value="Login">
                    </div>
                </form>
                <form class="signupForm" id="signupForm" method="POST">
                    <span>Signup</span>
                    <div class="inputContainer">
                        <input type="hidden" name="submit_type" value="signup">
                        <input type="text" name="name" id="signupName" placeholder="Fullname">
                        <input type="text" name="email" id="signupEmail" placeholder="Email">
                        <input type="text" name="username" id="signupUsername" placeholder="Username">
                        <input type="password" name="password" id="signupPassword" placeholder="Password">
                        <input type="password" name="confirmPassword" id="signupConfirmPassword"
                            placeholder="Confirm Password">
                    </div>
                    <div id="signupMessageContainer" class="messageContainer">
                        <span></span>
                    </div>
                    <div class="submitContainer">
                        <input type="submit" name="signup" id="signupSubmit" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="src/index.js"></script>
</body>

</html>