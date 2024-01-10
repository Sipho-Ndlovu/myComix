<?php

public function __construct(
    public string $fullName,
    public string $username,
    public string $password,
    public string $confirmPassword,
    public string $email
) {
    if (empty($fullName)) {
        throw new InvalidArgumentException("Please enter your Full Name!");
    }
    if (empty($username)) {
        throw new InvalidArgumentException("Please enter a Username!");
    }
    if (empty($password)) {
        throw new InvalidArgumentException("Please enter a Password!");
    }
    if (empty($confirmPassword)) {
        throw new InvalidArgumentException("Please confirm your Password!");
    }
    if (empty($email)) {
        throw new InvalidArgumentException("Please enter your Email!");
    }
    if ($password !== $confirmPassword) {
        throw new InvalidArgumentException("Passwords do not match!");
    }
    if (strlen($password) < 8) {
        throw new InvalidArgumentException("Password must be at least 8 characters!");
    }
    if (!preg_match("#[0-9]+#", $password)) {
        throw new InvalidArgumentException("Password must include at least one number!");
    }
    if (!preg_match("#[A-Z]+#", $password)) {
        throw new InvalidArgumentException("Password must include at least one uppercase letter!");
    }
    if (!preg_match("#[^a-zA-Z0-9]+#", $password)) {
        throw new InvalidArgumentException("Password must include at least one special character!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException("Please enter a valid Email!");
    }
}
    
?>
