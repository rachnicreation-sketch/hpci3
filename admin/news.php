<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once('../includes/db.php');

// Suppression d'une actualité
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: news.php?msg=deleted");
    exit;
}

// Récupération des actualités
$stmt = $pdo->query("SELECT * FROM news ORDER BY published_at DESC");
$news_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion Actualités — HPCI CMS</title>
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
  
  .table-card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; }
  table { width: 100%; border-collapse: collapse; text-align: left; }
  th { background: #f8fafc; padding: 20px; font-size: 0.75rem; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
  td { padding: 20px; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; vertical-align: middle; }
  .actu-img { width: 60px; height: 40px; border-radius: 4px; object-fit: cover; background: #f1f5f9; }
  .btn-delete { color: #e30613; text-decoration: none; font-weight: 600; padding: 8px; }
  .btn-delete:hover { text-decoration: underline; }
</style>
</head>
<body>
  <div class="sidebar">
    <div style="margin-bottom: 40px;"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height: 48px;"></div>
    <h2>Administration CMS</h2>
    <a href="index.php">Tableau de Bord</a>
    <a href="news.php" class="active">Actualités</a>
    <a href="media.php">Médiathèque</a>
    <a href="jobs.php">Offres d'Emploi</a>

    <a href="logout.php" class="logout">Déconnexion</a>
  </div>

  <div class="main-content">
    <div class="admin-header">
      <h1>Gestion des Actualités</h1>
      <a href="news_add.php" class="btn-primary" style="text-decoration: none;">+ Nouvelle Actualité</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
      <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">L'actualité a été supprimée.</div>
    <?php endif; ?>

    <div class="table-card">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($news_list as $news): ?>
          <tr>
            <td>
              <?php if ($news['image_url']): ?>
                <img src="../<?php echo $news['image_url']; ?>" class="actu-img">
              <?php else: ?>
                <div class="actu-img" style="display:flex;align-items:center;justify-content:center;">📰</div>
              <?php endif; ?>
            </td>
            <td style="font-weight: 700; color: #0a1628;"><?php echo htmlspecialchars($news['title']); ?></td>
            <td><span style="background: #f1f5f9; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;"><?php echo htmlspecialchars($news['category']); ?></span></td>
            <td style="color: #64748b;"><?php echo date('d/m/Y', strtotime($news['published_at'])); ?></td>
            <td>
              <a href="?delete=<?php echo $news['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer définitivement cette actualité ?')" title="Supprimer"><i class="fa-solid fa-trash-can"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if (empty($news_list)): ?>
          <tr>
            <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">Aucune actualité publiée pour le moment.</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
