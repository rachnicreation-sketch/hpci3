<?php
require_once(__DIR__ . '/db.php');

$stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'maintenance_mode'");
$stmt->execute();
$maintenance = $stmt->fetchColumn();

// Si le mode maintenance est actif ET que nous ne sommes pas dans le dossier admin
if ($maintenance === 'on' && strpos($_SERVER['PHP_SELF'], '/admin/') === false && basename($_SERVER['PHP_SELF']) !== 'maintenance.php') {
    header("Location: " . (strpos($_SERVER['PHP_SELF'], '/pages/') !== false ? '../maintenance.php' : 'maintenance.php'));
    exit;
}
?>
