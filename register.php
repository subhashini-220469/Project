<?php
session_start();
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';

    // Validation
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($cpassword)) {
        die("<p style='color:red;'>All fields are required.</p><a href='register.html'>Try Again</a>");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<p style='color:red;'>Invalid email format.</p><a href='register.html'>Try Again</a>");
    }

    if (strlen($password) < 6) {
        die("<p style='color:red;'>Password must be at least 6 characters long.</p><a href='register.html'>Try Again</a>");
    }

    if ($password !== $cpassword) {
        die("<p style='color:red;'>Passwords do not match.</p><a href='register.html'>Try Again</a>");
    }

    $collection = $db->users;

    // Check Duplicate Case
    $existingUser = $collection->findOne(['email' => $email]);
    if ($existingUser) {
        die("<p style='color:red;'>An account with this email already exists.</p><a href='register.html'>Try Again</a>");
    }

    // Insert Document
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = [
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'password' => $hashedPassword,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    try {
        $result = $collection->insertOne($newUser);
        if ($result->getInsertedCount() === 1) {
            echo "<p style='color:green;'>Registration successful!</p><a href='login.html'>Go to Login</a>";
        } else {
            die("<p style='color:red;'>Registration failed. Please try again later.</p><a href='register.html'>Try Again</a>");
        }
    } catch (Exception $e) {
        die("<p style='color:red;'>Database Error: " . $e->getMessage() . "</p><a href='register.html'>Try Again</a>");
    }
} else {
    // If someone visits register.php directly
    header("Location: register.html");
    exit();
}
