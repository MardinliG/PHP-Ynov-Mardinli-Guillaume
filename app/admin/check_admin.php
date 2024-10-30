<?php
session_start();
require '../database/db.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../register/login.php");
    exit();
}

// Fetch the user's role from the database
$stmt = $pdo->prepare('SELECT role FROM admin WHERE id = ?');
$stmt->execute([$_SESSION['admin_id']]);
$user = $stmt->fetch();

// Check if the user has the 'admin' role
if ($user['role'] !== 'admin') {
    echo "Access denied. You do not have permission to access this page.";
    exit();
}
?>