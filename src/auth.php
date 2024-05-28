<?php

require_once 'UserModel.php';

$db = new PDO('mysql:host=host.docker.internal;port=3306;dbname=mycomixdb', 'root', 'Koolkat2001!');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$userModel = new UserModel($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['submit'] == 'Login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $errorMessage = "Please enter your username!";
        } else if (empty($password)) {
            $errorMessage = "Please enter your password!";
        }
        try {
            if (isset($errorMessage)) {
                throw new Exception($errorMessage);
            }
            $query = $db->prepare('SELECT * FROM `users` WHERE `username` = :username');
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() == 0) {
                $errorMessage = "Invalid username or password!";
                throw new Exception($errorMessage);
            }
            if (!$userModel->login($username, $password)) {
                $errorMessage = "Invalid username or password!";
                throw new Exception($errorMessage);
            }
            $userModel->login($username, $password);
            echo '<script>document.querySelector("#loginMessageContainer").innerHTML = "Login Successful!";</script>';
            echo '<script>document.querySelector("#loginMessageContainer").classList.add("success");</script>';
            echo '<script>document.querySelector(".messageContainer").style.display = "flex";</script>';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            echo '<script>console.error("' . addslashes($errorMessage) . '");</script>';

            echo '<script>document.querySelector("#loginMessageContainer").innerHTML = "' . addslashes($errorMessage) . '";</script>';
            echo '<script>document.querySelector("#loginMessageContainer").classList.add("error");</script>';
        }
    } elseif ($_POST['submit'] == 'Signup') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $email = $_POST['email'];
        try {
            $user = new User($name, $username, $password, $confirmPassword, $email);
            echo "<script>console.log('user: " . json_encode($user) . "');</script>";

            if ($password === $confirmPassword) {
                // Check if username already exists
                $query = $db->prepare('SELECT COUNT(*) FROM `users` WHERE `username` = :username');
                $query->bindParam(':username', $username, PDO::PARAM_STR);
                $query->execute();
                if ($query->fetchColumn() > 0) {
                    throw new InvalidArgumentException("Username already exists!");
                }

                // Check if email already exists
                $query = $db->prepare('SELECT COUNT(*) FROM `users` WHERE `email` = :email');
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->execute();
                if ($query->fetchColumn() > 0) {
                    throw new InvalidArgumentException("Email already in use!");
                }

                $userModel->signUp($user);

                echo '<script>document.querySelector("#signupMessageContainer").innerHTML = "Signup successful!";</script>';
                echo '<script>document.querySelector("#signupMessageContainer").classList.add("success");</script>'; // Add success class
                echo '<script>document.querySelector(".signupForm .messageContainer").style.display = "flex";</script>';

            } else {
                throw new InvalidArgumentException("Passwords do not match!");
            }
        } catch (Exception $e) {
            // Log error message to console
            echo '<script>console.error("' . addslashes($e->getMessage()) . '");</script>';

            // Display error message
            echo '<script>document.querySelector("#signupMessageContainer").innerHTML = "' . addslashes($e->getMessage()) . '";</script>';
            echo '<script>document.querySelector(".messageContainer").style.display = "flex";</script>';

        }
    }
}
?>