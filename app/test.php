<?php
require('fpdf186/fpdf.php');
session_start();
require 'db.php';

// Prévenir toute sortie avant la génération du PDF
ob_start();

// Vérifier si un utilisateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'admin_id depuis l'URL
if (isset($_GET['user_id'])) {
    $admin_id = $_GET['user_id']; // Utilisez l'ID passé via l'URL
} else {
    // Si aucun ID n'est passé, redirigez vers la galerie ou une autre page
    header("Location: gallery.php");
    exit();
}

try {
    $stmt = $pdo->prepare('SELECT * FROM personal_info WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $personalInfo = $stmt->fetch();

    $stmt = $pdo->prepare('SELECT * FROM experiences WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $experiences = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT * FROM skills WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $skills = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT * FROM projects WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $projects = $stmt->fetchAll();

    $stmt = $pdo->prepare('SELECT * FROM contact WHERE admin_id = ?');
    $stmt->execute([$admin_id]);
    $contact = $stmt->fetch();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Personal Info
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $personalInfo['name']), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $personalInfo['title']), 0, 1, 'C');
$pdf->Ln(10);

// About
$pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1', $personalInfo['about']), 0, 'C');
$pdf->Ln(10);

// Experience
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Experience'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
foreach ($experiences as $exp) {
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $exp['ExperienceTitle']), 0, 1, 'C');
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $exp['company']) . ' | ' . iconv('UTF-8', 'ISO-8859-1', $exp['period']), 0, 1, 'C');
    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1', $exp['description']), 0, 'C');
    $pdf->Ln(5);
}

// Skills
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Skills'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
foreach ($skills as $skill) {
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $skill['SkillName']) . ' (' . $skill['level'] . '/10)', 0, 1, 'C');
}

// Projects
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Projects'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
foreach ($projects as $project) {
    $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', $project['ProjectName']), 0, 1, 'C');
}

// Contact
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Contact'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Email: ' . $contact['email']), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Phone: ' . $contact['phone']), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Location: ' . $contact['location']), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'LinkedIn: ' . $contact['linkedin']), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'GitHub: ' . $contact['github']), 0, 1, 'C');

// Envoyer le fichier PDF
ob_end_clean(); // Nettoyer le buffer de sortie avant de générer le PDF
$pdf->Output('D', 'cv_' . preg_replace('/[^a-zA-Z0-9]/', '_', $personalInfo['name']) . '.pdf');
?>
