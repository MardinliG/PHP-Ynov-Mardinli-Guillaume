<?php
require('fpdf186/fpdf.php');
require 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT * FROM personal_info');
    $stmt->execute();
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/gallery.css">
</head>
<body>
<header>
    <h1><i class="fas fa-id-card"></i> CV Gallery</h1>
    <a href="index.php" class="back-btn"><i class="fas fa-home"></i> Back to Home</a>
</header>
<main class="container">
    <?php foreach ($users as $user): ?>
        <div class="cv-preview">
            <div class="cv-header">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p class="title"><?php echo htmlspecialchars($user['title']); ?></p>
            </div>
            <div class="cv-content">
                <p class="about"><?php echo htmlspecialchars($user['about']); ?></p>

                <?php
                $stmt = $pdo->prepare('SELECT * FROM experiences WHERE admin_id = ?');
                $stmt->execute([$user['admin_id']]);
                $experiences = $stmt->fetchAll();

                $stmt = $pdo->prepare('SELECT * FROM skills WHERE admin_id = ?');
                $stmt->execute([$user['admin_id']]);
                $skills = $stmt->fetchAll();
                ?>

                <h3><i class="fas fa-briefcase"></i> Experience</h3>
                <div class="experiences">
                    <?php foreach ($experiences as $exp): ?>
                        <div class="experience-item">
                            <h4><?php echo htmlspecialchars($exp['ExperienceTitle']); ?></h4>
                            <p class="company"><?php echo htmlspecialchars($exp['company']) . ' | ' . htmlspecialchars($exp['period']); ?></p>
                            <p class="description"><?php echo htmlspecialchars($exp['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h3><i class="fas fa-cogs"></i> Skills</h3>
                <div class="skills">
                    <?php foreach ($skills as $skill): ?>
                        <div class="skill-item">
                            <p><?php echo htmlspecialchars($skill['SkillName']); ?></p>
                            <div class="skill-bar">
                                <div class="skill-level" style="width: <?php echo htmlspecialchars($skill['level'] * 10); ?>%;"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="download_cv.php?user_id=<?php echo $user['admin_id']; ?>" class="download-btn">
                <i class="fas fa-download"></i> Download CV
            </a>
        </div>
    <?php endforeach; ?>
</main>
<footer>
    <p>&copy; 2024 CV Gallery. All rights reserved. Mardinli Guillaume</p>
</footer>
</body>
</html>