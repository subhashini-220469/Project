<?php
session_start();
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$userId = $_SESSION['user_id'];
$collection = $db->users;
$currentUser = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);

if (!$currentUser) {
    session_destroy();
    header("Location: login.html");
    exit();
}

// Fetch all users for the optional user management requirement
$allUsers = $collection->find();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { background-color: white; padding: 30px; border-radius: 8px; max-width: 800px; margin: auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1, h2 { color: #0a1f44; }
        .nav { margin-bottom: 20px; }
        .nav a { background-color: #d9534f; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; float: right; }
        .nav a:hover { background-color: #c9302c; }
        .card { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button, .btn { padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; color: white; }
        .btn-update { background-color: #5cb85c; }
        .btn-update:hover { background-color: #4cae4c; }
        .btn-delete { background-color: #d9534f; }
        .btn-delete:hover { background-color: #c9302c; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="logout.php">Logout</a>
            <a href="index.html" style="background-color: #007bff; margin-right: 15px;">Home</a>
        </div>
        <h1>Welcome, <?php echo htmlspecialchars($currentUser['fname'] . ' ' . $currentUser['lname']); ?>!</h1>

        <!-- Update Profile Section (Update Document) -->
        <div class="card">
            <h2>Update Profile</h2>
            <form action="update_profile.php" method="POST">
                <label>First Name:</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($currentUser['fname']); ?>" required>
                <label>Last Name:</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($currentUser['lname']); ?>" required>
                <label>New Password (leave blank to keep current):</label>
                <input type="password" name="password" placeholder="New Password">
                <button type="submit" class="btn btn-update">Update details</button>
            </form>
        </div>

        <!-- Delete Account Section (Delete Document) -->
        <div class="card">
            <h2>Delete Account</h2>
            <form action="delete_account.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                <button type="submit" class="btn btn-delete">Delete My Account</button>
            </form>
        </div>

        <!-- User Management (Read Documents/List Users) -->
        <div class="card">
            <h2>Registered Users</h2>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['fname']); ?></td>
                    <td><?php echo htmlspecialchars($user['lname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
