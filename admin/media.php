<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once('../includes/db.php');

// Suppression d'un média
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM media WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: media.php?msg=deleted");
    exit;
}

// Récupération des médias
$stmt = $pdo->query("SELECT * FROM media ORDER BY created_at DESC");
$media_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestion Médiathèque — HPCI CMS</title>
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
  
  .media-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 24px; }
  .media-item { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; position: relative; }
  .media-thumb { height: 150px; background: #f1f5f9 center/cover no-repeat; }
  .media-info { padding: 12px; font-size: 0.8rem; color: #64748b; }
  .media-actions { position: absolute; top: 10px; right: 10px; display: flex; gap: 8px; }
  .btn-delete-small { background: #fee2e2; color: #991b1b; border: none; padding: 6px; border-radius: 4px; cursor: pointer; font-size: 0.75rem; text-decoration: none; }
</style>
</head>
<body>
  <div class="sidebar">
    <div style="margin-bottom: 40px;"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height: 48px;"></div>
    <h2>Administration CMS</h2>
    <a href="index.php">Tableau de Bord</a>
    <a href="news.php">Actualités</a>
    <a href="media.php" class="active">Médiathèque</a>
    <a href="jobs.php">Offres d'Emploi</a>

    <a href="logout.php">Déconnexion</a>
  </div>

  <div class="main-content">
    <div class="admin-header">
      <h1>Médiathèque</h1>
      <a href="media_add.php" class="btn-primary" style="text-decoration: none;">+ Ajouter un Média</a>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
      <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 24px;">Média supprimé.</div>
    <?php endif; ?>

    <div class="media-grid">
      <?php foreach ($media_list as $item): ?>
      <div class="media-item">
        <div class="media-thumb" style="background-image: url('../<?php echo $item['file_url']; ?>');"></div>
        <div class="media-actions">
          <a href="?delete=<?php echo $item['id']; ?>" class="btn-delete-small" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer"><i class="fa-solid fa-trash-can"></i></a>
        </div>
        <div class="media-info">
          <div style="font-weight: 700; color: #0a1628;"><?php echo mb_strimwidth(htmlspecialchars($item['title']), 0, 20, "..."); ?></div>
          <div><?php echo strtoupper($item['type']); ?></div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($media_list)): ?>
      <p style="grid-column: 1/-1; text-align: center; color: #94a3b8; padding: 100px 0;">Aucun média dans la bibliothèque.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
