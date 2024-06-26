<?php

require_once 'User.php';
class UserModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function signUp(User $user) {
            $hashedPassword = password_hash($user->password, PASSWORD_DEFAULT);
    
            $query = $this->db->prepare('INSERT INTO `users` (`username`, `password`, `name`, `email`) VALUES (?, ?, ?, ?)');
            $query->execute([$user->username, $hashedPassword, $user->name, $user->email]);
    
            return $query->rowCount() > 0;
    }    

    public function login($username, $password) {
        $query = $this->db->prepare('SELECT * FROM `users` WHERE `username` = ?');
        $query->execute([$username]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            return true;
        }
        else {
            throw new InvalidArgumentException("Invalid username or password!");
        }

    }

    public function logout() {
        session_start();
        if(isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            session_destroy();
            return true;
        }
        return false;
    }
    
}
