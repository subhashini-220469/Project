<?php
require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

try {
    $client = new MongoDB\Client($config['MONGODB_URI']);
    // Select the database
    $db = $client->selectDatabase($config['DB_NAME']);
} catch (Exception $e) {
    die("Database Connection Error: " . $e->getMessage());
}
