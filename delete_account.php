<?php
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $collection = $db->users;

    try {
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);
        session_destroy();
        echo "<p style='color:green;'>Account deleted successfully.</p><a href='register.html'>Register again</a>";
        exit();
    } catch (Exception $e) {
        die("<p style='color:red;'>Database Error: " . $e->getMessage() . "</p><a href='dashboard.php'>Go Back</a>");
    }
} else {
    header("Location: dashboard.php");
    exit();
}
