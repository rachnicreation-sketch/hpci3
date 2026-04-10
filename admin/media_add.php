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
    $title = $_POST['title'];
    $type = $_POST['type'];
    $file_url = "";

    // Gestion de l'upload de média
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov'];
        $filename = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_name = uniqid() . '.' . $ext;
            $upload_path = '../images/mediatheque/' . $new_name;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
                $file_url = 'images/mediatheque/' . $new_name;
            }
        }
    }

    if ($file_url) {
        $stmt = $pdo->prepare("INSERT INTO media (title, file_url, type) VALUES (?, ?, ?)");
        if ($stmt->execute([$title, $file_url, $type])) {
            $success = "Le média a été ajouté à la bibliothèque.";
        } else {
            $error = "Une erreur est survenue.";
        }
    } else {
        $error = "Échec du téléchargement du fichier.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un Média — HPCI CMS</title>
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
  .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.03em; }
  .form-group input, .form-group select { width: 100%; padding: 14px; border: 1px solid #e2e8f0; border-radius: 8px; }
  .btn-submit { background: #e8a020; color: white; border: none; padding: 16px 32px; border-radius: 8px; font-weight: 700; cursor: pointer; text-transform: uppercase; }
  .success-msg { background: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 24px; }
</style>
</head>
<body>
  <div class="sidebar">
    <div style="margin-bottom: 40px;"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height: 48px;"></div>
    <h2>Administration CMS</h2>
    <a href="index.php">Tableau de Bord</a>
    <a href="news.php">Actualités</a>
    <a href="media.php" class="active">Médiathèque</a>
    <a href="logout.php">Déconnexion</a>
  </div>

  <div class="main-content">
    <div class="admin-header">
      <a href="media.php" style="text-decoration: none; color: #64748b; font-weight: 700;">← Retour</a>
      <h1>Ajouter un Média</h1>
    </div>

    <?php if ($success): ?><div class="success-msg"><?php echo $success; ?></div><?php endif; ?>

    <div class="form-card">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Nom du média (Optionnel)</label>
          <input type="text" id="title" name="title" placeholder="Ex: Intervention Raffinerie CORAF">
        </div>
        <div class="form-group">
          <label for="type">Type de média</label>
          <select id="type" name="type" required>
            <option value="image">Image (JPG, PNG, GIF)</option>
            <option value="video">Vidéo (MP4, MOV)</option>
          </select>
        </div>
        <div class="form-group">
          <label for="file">Fichier</label>
          <input type="file" id="file" name="file" required>
        </div>
        <button type="submit" class="btn-submit">Uploader le média</button>
      </form>
    </div>
  </div>
</body>
</html>
