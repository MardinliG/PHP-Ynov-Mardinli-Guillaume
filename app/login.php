<?php
session_start();
require 'db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to fetch the user by username
    $stmt = $pdo->prepare('SELECT * FROM admin WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    // If the admin user is found, verify the password
    if ($admin['password'] && password_verify($password, $admin['password'])) {
        // Set session for admin user
        $_SESSION['admin_id'] = $admin['id'];
        // Redirect to the CV page
        header("Location:index.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <div class="login-form">
        <h2><i class="fas fa-user-shield"></i> Login </h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <label for="username"><i class="fas fa-user"></i></label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="create-account">
            <a href="createUser.php">Create Account <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
</body>
</html>