<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation
    if (empty($email) || empty($password)) {
        die("<p style='color:red;'>Email and password are required.</p><a href='login.html'>Try Again</a>");
    }

    $collection = $db->users;

    // Read Document & Authenticate
    try {
        $user = $collection->findOne(['email' => $email]);
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = (string) $user['_id'];
            $_SESSION['user_fname'] = $user['fname'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: index.html");
            exit();
        } else {
            die("<p style='color:red;'>Invalid email or password.</p><a href='login.html'>Try Again</a>");
        }
    } catch (Exception $e) {
        die("<p style='color:red;'>Database Error: " . $e->getMessage() . "</p><a href='login.html'>Try Again</a>");
    }

} else {
    header("Location: login.html");
    exit();
}
