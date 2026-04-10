<?php
require_once('../includes/maintenance_check.php');
require_once('../includes/db.php');

$stmt = $pdo->query("SELECT * FROM news ORDER BY published_at DESC");
$news_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualités — HPCI-SARL</title>
<link rel="stylesheet" href="../style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  .news-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; margin-top: 48px; }
  .news-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; transition: all 0.3s; }
  .news-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
  .news-img { height: 220px; background: #f1f5f9 center/cover no-repeat; }
  .news-body { padding: 24px; }
  .news-category { font-size: 0.75rem; font-weight: 700; color: #e8a020; text-transform: uppercase; margin-bottom: 8px; display: block; }
  .news-body h3 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.4rem; color: #0a1628; margin-bottom: 12px; }
  .news-date { color: #64748b; font-size: 0.85rem; }
</style>
</head>
<body data-root="../">

<nav>
  <div class="nav-inner">
    <a href="../index.php" class="logo"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height:48px;"></a>
    <ul class="nav-links">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="actualite.php" class="active">Actualité</a></li>
      <li><a href="contact.html" class="nav-cta">Nous contacter</a></li>
    </ul>
  </div>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <h1>Actualités HPCI-SARL</h1>
    <p>Restez informé de nos projets, innovations et engagements sur le terrain.</p>
  </div>
</section>

<section class="container">
  <div class="news-grid">
    <?php foreach ($news_list as $news): ?>
      <div class="news-card">
        <div class="news-img" style="background-image: url('../<?php echo $news['image_url']; ?>');">
          <?php if (!$news['image_url']): ?><div style="height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:3rem;">📰</div><?php endif; ?>
        </div>
        <div class="news-body">
          <span class="news-category"><?php echo htmlspecialchars($news['category']); ?></span>
          <h3><?php echo htmlspecialchars($news['title']); ?></h3>
          <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 24px; line-height: 1.6;"><?php echo mb_strimwidth(htmlspecialchars($news['content']), 0, 150, "..."); ?></p>
          <div class="news-date"><i class="fa-solid fa-calendar-days"></i> <?php echo date('d/m/Y', strtotime($news['published_at'])); ?></div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (empty($news_list)): ?>
      <p style="grid-column: 1/-1; text-align: center; color: #94a3b8; padding: 100px 0;">Aucune actualité n'a été publiée pour le moment.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <div class="footer-bottom"><p>© 2024 HPCI-SARL — Tous droits réservés.</p></div>
</footer>

</body>
</html>
