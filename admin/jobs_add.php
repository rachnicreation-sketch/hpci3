<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once('../includes/db.php');

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $deadline = $_POST['deadline'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO jobs (job_title, location, deadline, description) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$job_title, $location, $deadline, $description])) {
        $success = "L'offre d'emploi a été publiée avec succès.";
    } else {
        $error = "Une erreur est survenue.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Publier une Offre — HPCI CMS</title>
<link rel="stylesheet" href="../style.css">
<style>
  body { background: #f8fafc; font-family: 'Barlow', sans-serif; display: flex; min-height: 100vh; }
  .sidebar { width: 280px; background: #0a1628; color: white; padding: 40px 20px; display: flex; flex-direction: column; }
  .sidebar h2 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.2rem; color: #e8a020; margin-bottom: 48px; text-transform: uppercase; letter-spacing: 0.1em; }
  .sidebar a { color: #8fa3bf; text-decoration: none; padding: 12px 16px; border-radius: 8px; margin-bottom: 8px; transition: all 0.3s; font-size: 0.9rem; font-weight: 500; }
  .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.05); color: white; }
  
  .main-content { flex: 1; padding: 60px; }
  .admin-header { display: flex; align-items: center; gap: 20px; margin-bottom: 48px; }
  .admin-header h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 2rem; color: #0a1628; font-weight: 800; }
  
  .form-card { background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; max-width: 800px; }
  .form-group { margin-bottom: 24px; }
  .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
  .form-group input, .form-group textarea { width: 100%; padding: 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 1rem; color: #0a1628; }
  .form-group textarea { height: 150px; resize: none; }
  .btn-submit { background: #e8a020; color: #0a1628; border: none; padding: 16px 32px; border-radius: 8px; font-weight: 700; cursor: pointer; text-transform: uppercase; transition: all 0.3s; }
  .btn-submit:hover { background: #d4900f; transform: translateY(-2px); }
  .success-msg { background: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 24px; }
</style>
</head>
<body>
  <div class="sidebar">
    <div style="margin-bottom: 40px;"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height: 48px;"></div>
    <h2>Administration CMS</h2>
    <a href="index.php">Tableau de Bord</a>
    <a href="news.php">Actualités</a>
    <a href="media.php">Médiathèque</a>
    <a href="jobs.php" class="active">Offres d'Emploi</a>

    <a href="logout.php">Déconnexion</a>
  </div>

  <div class="main-content">
    <div class="admin-header">
      <a href="jobs.php" style="text-decoration: none; color: #64748b; font-weight: 700;">← Retour</a>
      <h1>Publier une Offre d'Emploi</h1>
    </div>

    <?php if ($success): ?><div class="success-msg"><?php echo $success; ?></div><?php endif; ?>

    <div class="form-card">
      <form action="" method="POST">
        <div class="form-group">
          <label for="job_title">Intitulé du poste</label>
          <input type="text" id="job_title" name="job_title" required placeholder="Ex: Technicien de Maintenance Industrielle">
        </div>
        <div class="form-group">
          <label for="location">Lieu d'affectation</label>
          <input type="text" id="location" name="location" required placeholder="Ex: Pointe-Noire, Congo">
        </div>
        <div class="form-group">
          <label for="deadline">Date limite de candidature</label>
          <input type="date" id="deadline" name="deadline" required>
        </div>
        <div class="form-group">
          <label for="description">Description de l'offre & Profil recherché</label>
          <textarea id="description" name="description" required placeholder="Détaillez les prérequis et missions..."></textarea>
        </div>
        <button type="submit" class="btn-submit">Publier l'offre</button>
      </form>
    </div>
  </div>
</body>
</html>
