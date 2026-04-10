<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once('../includes/db.php');

$success = "";
$error = "";

// Gestion du mode maintenance
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_maintenance'])) {
    $new_status = ($_POST['toggle_maintenance'] === 'on') ? 'on' : 'off';
    $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'maintenance_mode'");
    if ($stmt->execute([$new_status])) {
        $success = "Le mode maintenance a été mis à jour avec succès.";
    } else {
        $error = "Une erreur est survenue lors de la mise à jour.";
    }
}

// Récupération de l'état actuel de la maintenance
$stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = 'maintenance_mode'");
$stmt->execute();
$maintenance_status = $stmt->fetchColumn();

// Statistiques rapides
$count_news = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
$count_jobs = $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
$count_media = $pdo->query("SELECT COUNT(*) FROM media")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de Bord — HPCI CMS</title>
<link rel="stylesheet" href="../style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  body { background: #f8fafc; font-family: 'Barlow', sans-serif; display: flex; min-height: 100vh; }
  .sidebar { width: 280px; background: #0a1628; color: white; padding: 40px 20px; display: flex; flex-direction: column; }
  .sidebar h2 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.2rem; color: #e8a020; margin-bottom: 48px; text-transform: uppercase; letter-spacing: 0.1em; }
  .sidebar a { color: #8fa3bf; text-decoration: none; padding: 12px 16px; border-radius: 8px; margin-bottom: 8px; transition: all 0.3s; font-size: 0.9rem; font-weight: 500; }
  .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.05); color: white; }
  .sidebar a.logout { margin-top: auto; color: #e30613; }
  
  .main-content { flex: 1; padding: 60px; }
  .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 48px; }
  .admin-header h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 2rem; color: #0a1628; font-weight: 800; }
  
  .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 48px; }
  .stat-box { background: white; padding: 32px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
  .stat-box h3 { font-size: 0.75rem; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em; font-weight: 700; }
  .stat-box .number { font-family: 'Barlow Condensed', sans-serif; font-size: 2.5rem; font-weight: 800; color: #0a1628; }
  
  .dashboard-card { background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; margin-bottom: 32px; }
  .card-header { margin-bottom: 24px; }
  .card-header h2 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.5rem; color: #0a1628; }
  
  .maintenance-toggle { display: flex; align-items: center; gap: 20px; background: #fff5e6; padding: 24px; border-radius: 12px; border: 1px dashed #e8a020; }
  .maintenance-toggle .status { font-weight: 700; color: <?php echo ($maintenance_status === 'on') ? '#e30613' : '#2d8b57'; ?>; text-transform: uppercase; }
  .btn-submit { background: #0a1628; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 700; transition: all 0.3s; }
  .btn-submit:hover { background: #1a4480; }
  
  .success-msg { background: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 600; font-size: 0.9rem; }
</style>
</head>
<body>
  <div class="sidebar">
    <div style="margin-bottom: 40px;"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height: 48px;"></div>
    <h2>Administration CMS</h2>
    <a href="index.php" class="active">Tableau de Bord</a>
    <a href="news.php">Actualités</a>
    <a href="media.php">Médiathèque</a>
    <a href="jobs.php">Offres d'Emploi</a>

    <a href="logout.php" class="logout">Déconnexion</a>
  </div>

  <div class="main-content">
    <div class="admin-header">
      <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['admin_user']); ?></h1>
      <div style="color: #64748b; font-size: 0.9rem;"><i class="fa-solid fa-location-dot"></i> Pointe-Noire, Congo</div>
    </div>

    <?php if ($success): ?>
      <div class="success-msg"><?php echo $success; ?></div>
    <?php endif; ?>

    <div class="stats-grid">
      <div class="stat-box">
        <h3>Actualités Publiées</h3>
        <div class="number"><?php echo $count_news; ?></div>
      </div>
      <div class="stat-box">
        <h3>Offres Actives</h3>
        <div class="number"><?php echo $count_jobs; ?></div>
      </div>
      <div class="stat-box">
        <h3>Médias Stockés</h3>
        <div class="number"><?php echo $count_media; ?></div>
      </div>
    </div>

    <div class="dashboard-card">
      <div class="card-header">
        <h2>Disponibilité du Site</h2>
        <p style="color: #64748b; font-size: 0.9rem;">Activez le mode maintenance pour bloquer l'accès public pendant les mises à jour.</p>
      </div>
      <form action="" method="POST" class="maintenance-toggle">
        <div>État actuel : <span class="status"><?php echo ($maintenance_status === 'on') ? "En Maintenance" : "En Ligne"; ?></span></div>
        <input type="hidden" name="toggle_maintenance" value="<?php echo ($maintenance_status === 'on') ? "off" : "on"; ?>">
        <button type="submit" class="btn-submit">
          <?php echo ($maintenance_status === 'on') ? "Passer en Ligne" : "Activer la Maintenance"; ?>
        </button>
      </form>
    </div>

    <div class="dashboard-card">
      <div class="card-header">
        <h2>Actions Rapides</h2>
      </div>
      <div style="display: flex; gap: 16px;">
        <a href="news_add.php" class="btn-primary" style="text-decoration: none;">Publier une Actualité</a>
        <a href="jobs_add.php" class="btn-primary" style="background: #0a1628; text-decoration: none;">Publier une Offre</a>
        <a href="../index.html" target="_blank" class="btn-outline" style="color: #0a1628; border-color: #e2e8f0;">Visualiser le site</a>
      </div>
    </div>
  </div>
</body>
</html>
