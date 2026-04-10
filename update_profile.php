<?php
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($fname) || empty($lname)) {
        die("<p style='color:red;'>First and Last names are required.</p><a href='dashboard.php'>Go Back</a>");
    }

    $updateData = [
        'fname' => $fname,
        'lname' => $lname
    ];

    if (!empty($password)) {
        if (strlen($password) < 6) {
            die("<p style='color:red;'>Password must be at least 6 characters long.</p><a href='dashboard.php'>Go Back</a>");
        }
        $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $collection = $db->users;
    try {
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($userId)],
            ['$set' => $updateData]
        );
        
        $_SESSION['user_fname'] = $fname; // Update session info
        header("Location: index.html");
        exit();
    } catch (Exception $e) {
        die("<p style='color:red;'>Database Error: " . $e->getMessage() . "</p><a href='dashboard.php'>Go Back</a>");
    }
} else {
    header("Location: dashboard.php");
    exit();
}
