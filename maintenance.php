<?php
require_once('includes/db.php');
$stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'maintenance_message'");
$stmt->execute();
$msg = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maintenance en cours — HPCI-SARL</title>
<link rel="stylesheet" href="style.css">
<style>
  body { background: #0a1628; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; color: white; padding: 20px; }
  .maint-container { max-width: 600px; animation: fadeIn 1s ease; }
  .maint-logo { margin-bottom: 40px; }
  h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 2.5rem; margin-bottom: 24px; color: #e8a020; }
  p { font-size: 1.1rem; line-height: 1.6; color: #cbd5e1; margin-bottom: 40px; }
  .maint-bar { height: 4px; width: 60px; background: #e8a020; margin: 0 auto; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>
</head>
<body>
  <div class="maint-container">
    <div class="maint-logo"><img src="images/logo/logo-hpci.png" alt="Logo" style="height: 80px;"></div>
    <h1>Maintenance du Site</h1>
    <p><?php echo htmlspecialchars($msg); ?></p>
    <div class="maint-bar"></div>
    <div style="margin-top: 60px; font-size: 0.8rem; opacity: 0.5;">© 2024 HPCI-SARL — Équipes techniques en cours d'intervention.</div>
  </div>
</body>
</html>
