<?php
session_start();
require 'db.php'; // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

try {
    // Récupérer les informations personnelles depuis la base de données
    $stmt = $pdo->prepare('SELECT * FROM personal_info WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $personalInfo = $stmt->fetch();

    // Vérifier si les informations ont été récupérées
    if ($personalInfo === false) {
        // Si aucune donnée n'est trouvée, initialiser avec des valeurs par défaut
        $personalInfo = [
            'name' => 'N/A',
            'title' => 'N/A',
            'email' => 'N/A',
            'phone' => 'N/A',
            'profile_description' => 'N/A'
        ];
    }
} catch (PDOException $e) {
    // Gérer les erreurs liées à la base de données
    echo "Erreur : " . $e->getMessage();
    $personalInfo = [
        'name' => 'Erreur lors de la récupération des données',
        'title' => 'N/A',
        'email' => 'N/A',
        'phone' => 'N/A',
        'profile_description' => 'N/A'
    ];
}

// Gérer la soumission du formulaire et la mise à jour des données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profileDescription = $_POST['profileDescription'];

    try {
        // Mettre à jour les informations personnelles dans la base de données
        $stmt = $pdo->prepare('UPDATE personal_info SET name = ?, title = ?, email = ?, phone = ?, profile_description = ? WHERE admin_id = ?');
        $stmt->execute([$name, $title, $email, $phone, $profileDescription, $admin_id]);

        // Rediriger vers la page pour refléter les changements
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
    <!-- Section d'en-tête -->
    <header>
        <h1><?php echo htmlspecialchars($personalInfo['name']); ?></h1>
        <p><?php echo htmlspecialchars($personalInfo['title']); ?></p>
        <p>Email: <?php echo htmlspecialchars($personalInfo['email']); ?> | Téléphone: <?php echo htmlspecialchars($personalInfo['phone']); ?></p>
        <button id="editBtn">Modifier les informations</button>
        <a href="logout.php">Déconnexion</a>
    </header>

    <!-- Section Profil -->
    <section class="profile">
        <h2>Profil</h2>
        <p><?php echo htmlspecialchars($personalInfo['profile_description']); ?></p>
        <a href="test.php">Test</a>
    </section>

    <!-- Modal pour la mise à jour des informations personnelles -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modifier les informations personnelles</h2>
            <form method="POST" action="">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($personalInfo['name']); ?>" required>

                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($personalInfo['title']); ?>" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($personalInfo['email']); ?>" required>

                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($personalInfo['phone']); ?>" required>

                <label for="profileDescription">Description du profil :</label>
                <textarea id="profileDescription" name="profileDescription" required><?php echo htmlspecialchars($personalInfo['profile_description']); ?></textarea>

                <input type="submit" value="Sauvegarder les modifications">
            </form>
        </div>
    </div>
</div>

<script>
    // Gestion du modal et des éléments
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("editBtn");
    var span = document.getElementsByClassName("close")[0];

    // Ouvrir le modal lorsque le bouton "Modifier" est cliqué
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Fermer le modal lorsque le 'x' est cliqué
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Fermer le modal si l'utilisateur clique en dehors du contenu du modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>

</html>