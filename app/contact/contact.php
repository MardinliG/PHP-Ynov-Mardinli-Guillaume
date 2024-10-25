<?php
// Inclut la connexion à la base de données, les classes nécessaires et le fichier de configuration
require 'db.php';
require 'vendor/autoload.php';
require 'config.php';

// Démarre une session
session_start();

// Vérifie si l'ID utilisateur est fourni dans l'URL
if (!isset($_GET['user_id'])) {
    // Si non, affiche un message d'erreur et arrête le script
    echo "No user ID provided.";
    exit();
}

// Récupère l'ID utilisateur depuis l'URL
$user_id = $_GET['user_id'];

try {
    // Prépare une requête pour récupérer l'email de l'utilisateur à partir de son ID
    $stmt = $pdo->prepare('SELECT email FROM contact WHERE admin_id = ?');
    $stmt->execute([$user_id]);
    $contact = $stmt->fetch();

    // Si aucun utilisateur n'est trouvé, affiche un message d'erreur
    if (!$contact) {
        echo "User not found.";
        exit();
    }

    // Stocke l'email du contact récupéré
    $recipient_email = $contact['email'];
} catch (PDOException $e) {
    // En cas d'erreur de base de données, affiche un message et arrête le script
    echo "Error: " . $e->getMessage();
    exit();
}

// Variables pour gérer l'état de l'envoi du message
$message_sent = false;
$error_message = '';

// Vérifie si le formulaire a été soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère l'email de l'expéditeur et le message soumis par le formulaire
    $sender_email = $_POST['email'];
    $message = $_POST['message'];

    // Crée une instance de PHPMailer pour envoyer l'email
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com;smtp.gmail.com';
    $mail->SMTPAuth = true;
    // J'ai pas push le fichier config.php parce que il contient des infos privées
    $mail->Username = SMTP_USERNAME; // Utilise la constante définie dans config.php
    $mail->Password = SMTP_PASSWORD; // Utilise la constante définie dans config.php
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configure l'email : expéditeur, réponse, destinataire, sujet et contenu
    $mail->setFrom(SMTP_USERNAME, 'CV Craft');
    $mail->addReplyTo($sender_email);
    $mail->addAddress($recipient_email);
    $mail->Subject = 'Contact from CV Gallery';
    $mail->Body = $message;

    // Essaye d'envoyer l'email
    if ($mail->send()) {
        // Si l'envoi est réussi, indique que le message est envoyé
        $message_sent = true;
    } else {
        // Sinon, stocke l'erreur
        $error_message = "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - CV Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/contact.css">
</head>
<body>
<div class="container">
    <header>
        <h1><i class="fas fa-envelope"></i> Contact Us</h1>
        <p>Get in touch with the CV owner</p>
    </header>

    <?php if ($message_sent): ?>
        <div class="message success">
            <i class="fas fa-check-circle"></i>
            <p>Your message has been sent successfully!</p>
        </div>
    <?php elseif ($error_message): ?>
        <div class="message error">
            <i class="fas fa-exclamation-circle"></i>
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="form-group">
            <label for="email"><i class="fas fa-at"></i> Your Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message"><i class="fas fa-comment"></i> Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit"><i class="fas fa-paper-plane"></i> Send Message</button>
    </form>

    <a href="gallery.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
</div>
</body>
</html>