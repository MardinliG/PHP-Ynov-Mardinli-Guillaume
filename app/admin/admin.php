<?php
// Include the access check script
require 'check_admin.php';
require '../database/db.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['change_role'])) {
        $user_id = $_POST['user_id'];
        $new_role = $_POST['new_role'];
        $stmt = $pdo->prepare('UPDATE admin SET role = ? WHERE id = ?');
        $stmt->execute([$new_role, $user_id]);
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $pdo->prepare('DELETE FROM admin WHERE id = ?');
        $stmt->execute([$user_id]);
    } elseif (isset($_POST['toggle_display'])) {
        $user_id = $_POST['user_id'];
        $current_display = $_POST['current_display'];
        $new_display = $current_display ? 0 : 1;
        $stmt = $pdo->prepare('UPDATE personal_info SET display_in_gallery = ? WHERE admin_id = ?');
        $stmt->execute([$new_display, $user_id]);
    }
}

// Fetch all users
$stmt = $pdo->query('SELECT a.id, a.username, a.role, p.display_in_gallery FROM admin a LEFT JOIN personal_info p ON a.id = p.admin_id');
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CVCraft</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
    <div class="container">
        <h1><i class="fas fa-user-shield"></i> Admin Panel</h1>
        <nav>
            <a href="../public/index.php" class="btn btn-outline">Back to Home</a>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <section class="admin-table">
            <h2>User Management</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Display in Gallery</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo $user['display_in_gallery'] ? 'Yes' : 'No'; ?></td>
                        <td class="actions">
                            <form method="post" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <select name="new_role" class="select-role">
                                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                                </select>
                                <button type="submit" name="change_role" class="btn btn-small btn-change-role">Change Role</button>
                            </form>
                            <form method="post" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete_user" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                            <form method="post" class="inline-form">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <input type="hidden" name="current_display" value="<?php echo $user['display_in_gallery']; ?>">
                                <button type="submit" name="toggle_display" class="btn btn-small">
                                    <?php echo $user['display_in_gallery'] ? 'Remove from Gallery' : 'Add to Gallery'; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>

<footer>
    <div class="container">
        <p>&copy; 2024 CVCraft. All rights reserved. Mardinli Guillaume</p>
    </div>
</footer>
</body>
</html>