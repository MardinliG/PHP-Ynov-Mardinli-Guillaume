<?php
session_start();
require '../database/db.php'; // Include the database connection

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../register/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

try {
    // Fetch personal information
    $stmt = $pdo->prepare('SELECT * FROM personal_info WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $personalInfo = $stmt->fetch();

    // Fetch experiences
    $stmt = $pdo->prepare('SELECT * FROM experiences WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $experiences = $stmt->fetchAll();

    // Fetch skills
    $stmt = $pdo->prepare('SELECT * FROM skills WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $skills = $stmt->fetchAll();

    // Fetch projects
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $projects = $stmt->fetchAll();

    // Fetch contact information
    $stmt = $pdo->prepare('SELECT * FROM contact WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $contact = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Handle form submission and data update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Profilpics = $_POST['Profilpics'] ?? null;
    $name = $_POST['name'] ?? null;
    $title = $_POST['title'] ?? null;
    $about = $_POST['about'] ?? null;
    $skills = $_POST['skills'] ?? [];
    $projects = $_POST['projects'] ?? [];
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $location = $_POST['location'] ?? null;
    $linkedin = $_POST['linkedin'] ?? null;
    $github = $_POST['github'] ?? null;
    $ExperienceTitle = $_POST['ExperienceTitle'] ?? null;
    $company = $_POST['company'] ?? null;
    $period = $_POST['period'] ?? null;
    $description = $_POST['description'] ?? null;

    try {
        if ($Profilpics && $name && $title && $about) {
            $stmt = $pdo->prepare('UPDATE personal_info SET Profilpics = ?, name = ?, title = ?, about = ? WHERE admin_id = ?');
            $stmt->execute([$Profilpics, $name, $title, $about, $admin_id]);
        }

        foreach ($skills as $skill) {
            if (isset($skill['id']) && $skill['SkillName'] && $skill['level'] !== null) {
                $stmt = $pdo->prepare('UPDATE skills SET SkillName = ?, level = ? WHERE admin_id = ? AND id = ?');
                $stmt->execute([$skill['SkillName'], $skill['level'], $admin_id, $skill['id']]);
            }
        }

        foreach ($projects as $project) {
            if (isset($project['id']) && $project['ProjectName'] && $project['image']) {
                $stmt = $pdo->prepare('UPDATE projects SET ProjectName = ?, image = ? WHERE admin_id = ? AND id = ?');
                $stmt->execute([$project['ProjectName'], $project['image'], $admin_id, $project['id']]);
            }
        }

        if ($email && $phone && $location && $linkedin && $github) {
            $stmt = $pdo->prepare('UPDATE contact SET email = ?, phone = ?, location = ?, linkedin = ?, github = ? WHERE admin_id = ?');
            $stmt->execute([$email, $phone, $location, $linkedin, $github, $admin_id]);
        }

        if ($ExperienceTitle && $company && $period && $description) {
            $stmt = $pdo->prepare('UPDATE experiences SET ExperienceTitle = ?, company = ?, period = ?, description = ? WHERE admin_id = ?');
            $stmt->execute([$ExperienceTitle, $company, $period, $description, $admin_id]);
        }

        // Redirect to the page to reflect changes
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($personalInfo['name']); ?> - Interactive CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4m1zt7f1D8y+3C5i5M2k5z5z5z" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/index.css">

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css' rel='stylesheet' />


</head>
<body>
<div class="container">
    <nav class="top-nav">
        <div class="button-container">
            <button id="editBtn" class="btn btn-edit"><i class="fas fa-edit"></i> Modifier</button>
            <a href="../pdf/download_cv.php" class="btn btn-download"><i class="fas fa-download"></i> Télécharger CV</a>
            <a href="gallery.php" class="btn btn-gallery"><i class="fas fa-images"></i> Voir les CV</a>
            <a href="../register/logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
        </div>
    </nav>
    <header>
        <img src=<?php echo htmlspecialchars($personalInfo['Profilpics']); ?> alt="<?php echo htmlspecialchars($personalInfo['name']); ?>" class="profile-img">
        <h1><?php echo htmlspecialchars($personalInfo['name']); ?></h1>
        <div class="title"><?php echo htmlspecialchars($personalInfo['title']); ?></div>
    </header>

    <section class="about">
        <p><?php echo htmlspecialchars($personalInfo['about']); ?></p>
    </section>

    <section class="section">
        <h2>Experience</h2>
        <?php foreach ($experiences as $exp): ?>
            <div class="experience-item">
                <h3><?php echo htmlspecialchars($exp['ExperienceTitle']); ?></h3>
                <p><strong><?php echo htmlspecialchars($exp['company']); ?></strong> | <?php echo htmlspecialchars($exp['period']); ?></p>
                <p><?php echo htmlspecialchars($exp['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <section class="section">
        <h2>Skills</h2>
        <div class="skills">
            <?php foreach ($skills as $skill): ?>
                <div class="skill-item">
                    <div class="skill-name"><?php echo htmlspecialchars($skill['SkillName']); ?></div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-level="<?php echo htmlspecialchars($skill['level']); ?>"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2>Projects</h2>
        <div class="projects">
            <?php foreach ($projects as $project): ?>
                <div class="project-item">
                    <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['ProjectName']); ?>">
                    <div class="project-overlay">
                        <h3><?php echo htmlspecialchars($project['ProjectName']); ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <h2>Contact</h2>
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>"><?php echo htmlspecialchars($contact['email']); ?></a>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <a href="tel:<?php echo htmlspecialchars($contact['phone']); ?>"><?php echo htmlspecialchars($contact['phone']); ?></a>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span><?php echo htmlspecialchars($contact['location']); ?></span>
            </div>
        </div>
        <div class="social-links">
            <a href="<?php echo htmlspecialchars($contact['linkedin']); ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="<?php echo htmlspecialchars($contact['github']); ?>" target="_blank"><i class="fab fa-github"></i></a>
        </div>
    </section>
    <div id="map" style="height: 400px; width: 100%;"></div>
</div>

<!-- Edit Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier les informations personnelles</h2>
        <form method="POST" action="">
            <label for="Profilpics">Image de profil :</label>
            <input type="text" id="Profilpics" name="Profilpics" value="<?php echo htmlspecialchars($personalInfo['Profilpics']); ?>" required>

            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($personalInfo['name']); ?>" required>

            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($personalInfo['title']); ?>" required>

            <label for="about">À propos :</label>
            <textarea id="about" name="about" required><?php echo htmlspecialchars($personalInfo['about']); ?></textarea>

            <h2>Modifier les experiences</h2>
            <label for="ExperienceTitle">Titre :</label>
            <input type="text" id="ExperienceTitle" name="ExperienceTitle" value="<?php echo htmlspecialchars($exp['ExperienceTitle']); ?>" required>
            <label for="company">Entreprise :</label>
            <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($exp['company']); ?>" required>
            <label for="period">Période :</label>
            <input type="text" id="period" name="period" value="<?php echo htmlspecialchars($exp['period']); ?>" required>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($exp['description']); ?></textarea>

            <h2>Modifier les skills</h2>
            <?php foreach ($skills as $index => $skill): ?>
                <input type="hidden" name="skills[<?php echo $index; ?>][id]" value="<?php echo htmlspecialchars($skill['id']); ?>">
                <label for="SkillName<?php echo $index; ?>">Nom :</label>
                <input type="text" id="SkillName<?php echo $index; ?>" name="skills[<?php echo $index; ?>][SkillName]" value="<?php echo htmlspecialchars($skill['SkillName']); ?>" required>
                <label for="level<?php echo $index; ?>">Niveau :</label>
                <input type="range" class="form-range" id="level<?php echo $index; ?>" name="skills[<?php echo $index; ?>][level]" min="0" max="10" value="<?php echo htmlspecialchars($skill['level']); ?>" required>
            <?php endforeach; ?>

            <h2>Modifier les projets</h2>
            <?php foreach ($projects as $index => $project): ?>
                <input type="hidden" name="projects[<?php echo $index; ?>][id]" value="<?php echo htmlspecialchars($project['id']); ?>">
                <label for="ProjectName<?php echo $index; ?>">Nom :</label>
                <input type="text" id="ProjectName<?php echo $index; ?>" name="projects[<?php echo $index; ?>][ProjectName]" value="<?php echo htmlspecialchars($project['ProjectName']); ?>" required>
                <label for="image<?php echo $index; ?>">Image :</label>
                <input type="text" id="image<?php echo $index; ?>" name="projects[<?php echo $index; ?>][image]" value="<?php echo htmlspecialchars($project['image']); ?>" required>
            <?php endforeach; ?>

            <h2>Modifier les informations de contact</h2>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
            <label for="phone">Téléphone :</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
            <label for="location">Localisation :</label>
            <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($contact['location']); ?>" required>
            <label for="linkedin">LinkedIn :</label>
            <input type="text" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($contact['linkedin']); ?>" required>
            <label for="github">GitHub :</label>
            <input type="text" id="github" name="github" value="<?php echo htmlspecialchars($contact['github']); ?>" required>

            <input type="submit" value="Sauvegarder les modifications">
        </form>
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
<script>
    // Fonction pour mettre à jour les barres de progression
    function updateProgressBars() {
        // Sélectionnez toutes les barres de progression avec l'attribut data-level
        var progressBars = document.querySelectorAll('.skill-progress');

        // Pour chaque barre, récupérez le niveau de compétence et ajustez la largeur
        progressBars.forEach(function(bar) {
            var level = bar.getAttribute('data-level');  // Récupère le niveau
            if (level) {
                bar.style.width = (level * 10) + '%';  // La largeur est un pourcentage (niveau * 10)
            }
        });
    }

    // Appelez la fonction lors du chargement de la page
    window.onload = updateProgressBars;
</script>
<script>
    // Token d'accès à Mapbox
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ3VpZ3phbmNlIiwiYSI6ImNtMms4Y21tZTBjbm0yanNiam0yZHd0ZnMifQ.FqI49j0X-hhrNX70WeMUcQ'; // Remplacez par votre clé API

    // Adresse provenant de PHP
    var address = "<?php echo htmlspecialchars($contact['location']); ?>";

    // Initialisation de la carte Mapbox avec des coordonnées par d��faut
    var map = new mapboxgl.Map({
        container: 'map', // ID de l'élément où afficher la carte
        style: 'mapbox://styles/mapbox/streets-v12', // Style de la carte
        center: [2.3522, 48.8566], // Coordonnées initiales (Paris)
        zoom: 10 // Niveau de zoom initial
    });

    // Utilisation de Mapbox Geocoding API pour convertir l'adresse en latitude/longitude
    fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${mapboxgl.accessToken}`)
        .then(response => response.json())
        .then(data => {
            if (data.features && data.features.length > 0) {
                var coords = data.features[0].center; // [lng, lat]
                var placeName = data.features[0].place_name;

                // Centrer la carte sur l'adresse géocodée
                map.setCenter(coords);

                // Ajouter un marqueur à la position
                new mapboxgl.Marker()
                    .setLngLat(coords)
                    .addTo(map);

                console.log('Adresse géocodée :', placeName, 'Coordonnées :', coords);
            } else {
                alert('Adresse introuvable.');
            }
        })
        .catch(error => {
            console.error('Erreur lors du géocodage :', error);
            alert('Erreur lors du géocodage.');
        });
</script>

</body>
</html>