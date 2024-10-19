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
        $stmt = $pdo->prepare('INSERT INTO admins (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hashed_password]);

        $success_message = "Nouvel admin ajouté avec succès !";
    } catch (PDOException $e) {
        // Gérer les erreurs d'insertion (ex : si l'utilisateur existe déjà)
        $error_message = "Erreur lors de l'ajout de l'admin : " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouvel admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Créer un nouvel admin</h2>

        <?php if (isset($success_message)): ?>
            <p style="color:green;"><?php echo htmlspecialchars($success_message); ?></p>
            <p><a href="login.php">Cliquez ici pour vous connecter</a></p>
            <script>
                setTimeout(function() {
                    window.location.href = "login.php"; // Redirige après 5 secondes
                }, 5000); // 5000 millisecondes = 5 secondes
            </script>
        <?php endif; ?>


        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Créer un admin">
        </form>
    </div>
</body>
</html>
