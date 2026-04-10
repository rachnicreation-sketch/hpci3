<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once('../includes/db.php');

// Suppression d'une offre
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: jobs.php?msg=deleted");
    exit;
}

// Récupération des offres
$stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
$jobs_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion Emplois — HPCI CMS</title>
<link rel="stylesheet" href="../style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  body { background: #f8fafc; font-family: 'Barlow', sans-serif; display: flex; min-height: 100vh; }
  .sidebar { width: 280px; background: #0a1628; color: white; padding: 40px 20px; display: flex; flex-direction: column; }
  .sidebar h2 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.2rem; color: #e8a020; margin-bottom: 48px; text-transform: uppercase; letter-spacing: 0.1em; }
  .sidebar a { color: #8fa3bf; text-decoration: none; padding: 12px 16px; border-radius: 8px; margin-bottom: 8px; transition: all 0.3s; font-size: 0.9rem; font-weight: 500; }
  .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.05); color: white; }
  
  .main-content { flex: 1; padding: 60px; }
  .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 48px; }
  .admin-header h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 2rem; color: #0a1628; font-weight: 800; }
  
  .table-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; }
  table { width: 100%; border-collapse: collapse; text-align: left; }
  th { background: #f8fafc; padding: 20px; font-size: 0.75rem; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
  td { padding: 20px; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; vertical-align: middle; }
  .btn-delete { color: #e30613; text-decoration: none; font-weight: 600; padding: 8px; }
  .btn-delete:hover { text-decoration: underline; }
  .status-badge { background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; }
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
      <h1>Gestion des Emplois</h1>
      <a href="jobs_add.php" class="btn-primary" style="text-decoration: none;">+ Nouvelle Offre</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
      <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 24px;">L'offre d'emploi a été supprimée.</div>
    <?php endif; ?>

    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th>Poste</th>
            <th>Lieu</th>
            <th>Date limite</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($jobs_list as $job): ?>
          <tr>
            <td style="font-weight: 700; color: #0a1628;"><?php echo htmlspecialchars($job['job_title']); ?></td>
            <td><?php echo htmlspecialchars($job['location']); ?></td>
            <td style="color: #64748b;"><?php echo date('d/m/Y', strtotime($job['deadline'])); ?></td>
            <td><span class="status-badge">Actif</span></td>
            <td>
              <a href="?delete=<?php echo $job['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer définitivement cette offre ?')" title="Supprimer"><i class="fa-solid fa-trash-can"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if (empty($jobs_list)): ?>
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">Aucune offre d'emploi active.</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
