<?php
header('Content-Type: application/json; charset=UTF-8');

// Basic security check (Optional but recommended)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

// Retrieve and sanitize data
$prenom   = trim($_POST['prenom']   ?? '');
$nom      = trim($_POST['nom']      ?? '');
$email    = trim($_POST['email']    ?? '');
$tel      = trim($_POST['telephone']?? '');
$bureau   = trim($_POST['bureau']   ?? '');
$service  = trim($_POST['service']  ?? '');
$message  = trim($_POST['message']  ?? '');

$nomComplet = $prenom . ' ' . $nom;

// Validation
if (empty($prenom) || empty($nom) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires (*)']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail non valide.']);
    exit;
}

// Configuration de l'email
$recipient = 'hygieneprodige@hpci-sarl.net, info@hpci-sarl.net, rachnicreation@gmail.com';
$mailSubject = "Contact Site Web : " . ($service ?: "Demande générale");

$mailBody = "Nouveau message reçu depuis le site HPCI-SARL :\r\n\r\n";
$mailBody .= "--------------------------------------------------\r\n";
$mailBody .= "Nom Complet : {$nomComplet}\r\n";
$mailBody .= "E-mail      : {$email}\r\n";
$mailBody .= "Téléphone   : {$tel}\r\n";
$mailBody .= "Bureau      : {$bureau}\r\n";
$mailBody .= "Service     : {$service}\r\n";
$mailBody .= "--------------------------------------------------\r\n";
$mailBody .= "Message :\r\n{$message}\r\n";
$mailBody .= "--------------------------------------------------\r\n";

// Headers
$safeName = preg_replace('/[\r\n\"]+/', ' ', $nomComplet);
$headers = "From: \"{$safeName}\" <{$email}>\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Windows-specific sendmail configuration (if on WAMP)
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    @ini_set('sendmail_from', 'info@hpci-sarl.net');
}

// Sending the mail
if (mail($recipient, $mailSubject, $mailBody, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Votre message a été envoyé avec succès !']);
} else {
    echo json_encode(['success' => false, 'message' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer.']);
}
