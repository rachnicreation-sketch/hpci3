<?php
require_once('../includes/maintenance_check.php');
require_once('../includes/db.php');

$stmt = $pdo->query("SELECT * FROM jobs WHERE is_active = 1 ORDER BY created_at DESC");
$jobs_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recrutement — HPCI-SARL</title>
<link rel="stylesheet" href="../style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  .job-card { background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; margin-bottom: 24px; transition: all 0.3s; }
  .job-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: #e8a020; }
  .job-card h3 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.8rem; color: #0a1628; margin-bottom: 16px; }
  .job-info { display: flex; gap: 24px; margin-bottom: 24px; color: #64748b; font-size: 0.9rem; font-weight: 500; }
  .job-info i { color: #e8a020; margin-right: 6px; }
  .job-desc { font-size: 1rem; color: #334155; line-height: 1.7; margin-bottom: 32px; }
  .btn-apply { background: #0a1628; color: white; border: none; padding: 14px 28px; border-radius: 4px; font-weight: 700; text-decoration: none; display: inline-block; transition: all 0.3s; }
  .btn-apply:hover { background: #e8a020; color: #0a1628; }
</style>
</head>
<body data-root="../">

<nav>
  <div class="nav-inner">
    <a href="../index.php" class="logo"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height:48px;"></a>
    <ul class="nav-links">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="actualite.php">Actualité</a></li>
      <li><a href="emplois.php" class="active">Emplois</a></li>
      <li><a href="contact.html" class="nav-cta">Nous contacter</a></li>
    </ul>
  </div>
</nav>

<section class="page-hero">
  <div class="page-hero-inner">
    <h1>Rejoignez HPCI-SARL</h1>
    <p>Nous recherchons des talents pour accompagner notre croissance technique en Afrique.</p>
  </div>
</section>

<section class="container" style="padding-top: 80px; padding-bottom: 100px;">
  <div style="max-width: 900px; margin: 0 auto;">
    <?php foreach ($jobs_list as $job): ?>
      <div class="job-card">
        <h3><?php echo htmlspecialchars($job['job_title']); ?></h3>
        <div class="job-info">
          <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($job['location']); ?></span>
          <span><i class="fa-solid fa-calendar-days"></i> Date limite : <?php echo date('d/m/Y', strtotime($job['deadline'])); ?></span>
        </div>
        <div class="job-desc"><?php echo nl2br(htmlspecialchars($job['description'])); ?></div>
        <a href="mailto:info@hpci-sarl.net?subject=Candidature : <?php echo urlencode($job['job_title']); ?>" class="btn-apply">Postuler par Email →</a>
      </div>
    <?php endforeach; ?>
    <?php if (empty($jobs_list)): ?>
      <p style="text-align: center; color: #94a3b8; padding: 100px 0;">Aucune offre d'emploi active pour le moment. Suivez-nous pour les prochaines opportunités.</p>
    <?php endif; ?>
  </div>
</section>

<footer>
  <div class="footer-bottom"><p>© 2024 HPCI-SARL — Tous droits réservés.</p></div>
</footer>

</body>
</html>
