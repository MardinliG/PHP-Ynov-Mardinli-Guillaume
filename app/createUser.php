<?php
// Inclure la connexion à la base de données
require 'db.php'; // Assure-toi que ce fichier contient la connexion PDO

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe depuis le formulaire
    $username = $_POST['username'];
    $password_plain = $_POST['password'];

    // Hacher le mot de passe
    $hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête d'insertion
    try {
        $stmt = $pdo->prepare('INSERT INTO admin (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hashed_password]);

        $success_message = "Nouvel admin ajouté avec succès !";
    } catch (PDOException $e) {
        // Gérer les erreurs d'insertion (ex : si l'utilisateur existe déjà)
        $error_message = "Erreur lors de l'ajout de l'admin : " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouvel admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="createUser.css">
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2><i class="fas fa-user-plus"></i> Créer un nouvel admin</h2>

        <?php if (isset($success_message)): ?>
            <p class="success-message"><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?></p>
            <p class="redirect-message">Redirection vers la page de connexion dans <span id="countdown">5</span> secondes...</p>
            <p><a href="login.php" class="login-link">Cliquez ici pour vous connecter maintenant</a></p>
            <script>
                var seconds = 5;
                function countdown() {
                    document.getElementById('countdown').innerHTML = seconds;
                    if (seconds > 0) {
                        seconds--;
                        setTimeout(countdown, 1000);
                    } else {
                        window.location.href = "login.php";
                    }
                }
                countdown();
            </script>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <p class="error-message"><i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label for="username"><i class="fas fa-user"></i></label>
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="input-group">
                <label for="password"><i class="fas fa-lock"></i></label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <button type="submit" class="submit-btn">Créer un admin</button>
        </form>
        <div class="login-link-container">
            <a href="login.php" class="login-link">Retour à la connexion <i class="fas fa-sign-in-alt"></i></a>
        </div>
    </div>
</div>
</body>
</html>