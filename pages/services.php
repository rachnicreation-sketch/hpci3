<?php require_once('../includes/maintenance_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nos Services — HPCI-SARL</title>
<link rel="stylesheet" href="../style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
  .services-header { background: var(--navy); padding: 80px 0; color: white; text-align: center; }
  .services-header h1 { font-family: 'Barlow Condensed', sans-serif; font-size: 3rem; margin-bottom: 16px; }
  .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 32px; margin-top: 60px; }
  .service-card { background: white; border-radius: 16px; overflow: hidden; border: 1px solid var(--border); transition: all 0.4s; }
  .service-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.1); }
  .service-thumb { height: 240px; background-position: center; background-size: cover; }
  .service-body { padding: 32px; }
  .service-body h3 { font-family: 'Barlow Condensed', sans-serif; font-size: 1.5rem; color: var(--navy); margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
  .service-body h3 i { color: var(--accent); }
</style>
</head>
<body data-root="../">

<nav>
  <div class="nav-inner">
    <a href="../index.php" class="logo"><img src="../images/logo/logo-hpci.png" alt="Logo" style="height:48px;"></a>
    <ul class="nav-links">
      <li><a href="../index.php">Accueil</a></li>
      <li><a href="services.php" class="active">Services</a></li>
      <li><a href="contact.html" class="nav-cta">Nous contacter</a></li>
    </ul>
  </div>
</nav>

<section class="services-header">
  <div class="container">
    <h1>Solutions Techniques & Industrielles</h1>
    <p>Expertise panafricaine dans les métiers de l'hygiène et de la maintenance.</p>
  </div>
</section>

<section class="container">
  <div class="services-grid">
    <!-- Service 1 -->
    <div class="service-card">
      <div class="service-thumb" style="background-image: url('../images/services/nettoyage-industrielle.jpg');"></div>
      <div class="service-body">
        <h3><i class="fa-solid fa-industry"></i> Nettoyage Industriel</h3>
        <p>Interventions spécialisées en milieux critiques.</p>
        <a href="service-nettoyage-industriel.php" class="service-link">En savoir plus →</a>
      </div>
    </div>
    <!-- Service 2 -->
    <div class="service-card">
      <div class="service-thumb" style="background-image: url('../images/services/maintenance-industrielle.jpg');"></div>
      <div class="service-body">
        <h3><i class="fa-solid fa-gears"></i> Maintenance Industrielle</h3>
        <p>Entretien préventif et équipements techniques.</p>
        <a href="service-maintenance.php" class="service-link">En savoir plus →</a>
      </div>
    </div>
    <!-- Service 3 -->
    <div class="service-card">
      <div class="service-thumb" style="background-image: url('../images/services/nettoyage-pro.jpg');"></div>
      <div class="service-body">
        <h3><i class="fa-solid fa-broom"></i> Nettoyage Professionnel</h3>
        <p>Entretien d'espaces commerciaux et tertiaires.</p>
        <a href="service-nettoyage-pro.php" class="service-link">En savoir plus →</a>
      </div>
    </div>
  </div>
</section>

<footer style="margin-top: 100px;">
  <div class="footer-bottom">
    <p>© 2024 HPCI-SARL — Tous droits réservés.</p>
  </div>
</footer>

</body>
</html>
