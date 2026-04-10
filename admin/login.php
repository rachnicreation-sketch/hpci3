<?php
session_start();
require_once('../includes/db.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_user'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion Administration — HPCI-SARL</title>
<link rel="stylesheet" href="../style.css">
<style>
  body { background: #0a1628; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
  .login-card { background: white; padding: 48px; border-radius: 16px; width: 100%; max-width: 400px; box-shadow: 0 30px 60px rgba(0,0,0,0.4); text-align: center; }
  .login-logo { margin-bottom: 32px; }
  .login-card h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.8rem; color: #0a1628; margin-bottom: 32px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }
  .form-group { text-align: left; margin-bottom: 24px; }
  .form-group label { display: block; font-size: 0.82rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em; }
  .form-group input { width: 100%; padding: 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 1rem; color: #0a1628; transition: border-color 0.3s; }
  .form-group input:focus { outline: none; border-color: #e8a020; }
  .login-btn { width: 100%; background: #e8a020; color: #0a1628; border: none; padding: 16px; border-radius: 8px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.3s; text-transform: uppercase; }
  .login-btn:hover { background: #d4900f; transform: translateY(-2px); }
  .error-msg { color: #e30613; font-size: 0.88rem; margin-bottom: 24px; font-weight: 600; }
</style>
</head>
<body>
  <div class="login-card">
    <div class="login-logo">
      <img src="../images/logo/logo-hpci.png" alt="HPCI-SARL" style="height: 60px;">
    </div>
    <h1>Espace Administration</h1>
    <?php if ($error): ?>
      <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Utilisateur</label>
        <input type="text" id="username" name="username" required autocomplete="off">
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="login-btn">Se connecter</button>
    </form>
    <p style="margin-top: 32px; font-size: 0.75rem; color: #94a3b8;"><a href="../index.html" style="color: #64748b; text-decoration: none;">← Retour au site</a></p>
  </div>
</body>
</html>
