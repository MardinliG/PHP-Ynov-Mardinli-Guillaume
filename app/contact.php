<?php
require 'db.php';
require 'vendor/autoload.php';
session_start();

if (!isset($_GET['user_id'])) {
    echo "No user ID provided.";
    exit();
}

$user_id = $_GET['user_id'];

try {
    $stmt = $pdo->prepare('SELECT email FROM contact WHERE admin_id = ?');
    $stmt->execute([$user_id]);
    $contact = $stmt->fetch();

    if (!$contact) {
        echo "User not found.";
        exit();
    }

    $recipient_email = $contact['email'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'guillaume.mardinli@ynov.com';
    $mail->Password = 'Antananarivo*9931';
    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('guillaume.mardinli@ynov.com');
    $mail->addAddress($recipient_email);
    $mail->Subject = 'Contact from CV Gallery';
    $mail->Body = $message;

    if ($mail->send()) {
        $message_sent = true;
    } else {
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