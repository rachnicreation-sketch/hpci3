<?php require_once('includes/maintenance_check.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HPCI-SARL — Hygiène Prodige Com International</title>
<link rel="stylesheet" href="style.css">
<!-- Font Awesome 6.x -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
/* ... (Existing styles if any, but I'll replace the hero part) ... */
</style>
<script src="scripts/hero_slider.js" defer></script>
</head>
<body data-root="./">

<div class="topbar">
  <div class="topbar-inner">
    <div class="topbar-contacts">
      <a href="tel:+2252722240247"><i class="fa-solid fa-phone"></i> Abidjan : +225 27 222 402 47</a>
      <a href="tel:+242066652728"><i class="fa-solid fa-phone"></i> Pointe-Noire : +242 066 652 728</a>
    </div>
    <div class="topbar-social">
      <a href="https://www.facebook.com/profile.php?id=61565882327789" target="_blank" title="Facebook" class="sc-facebook"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="https://www.linkedin.com/company/hpci-abidjansarl/" target="_blank" title="LinkedIn" class="sc-linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
      <a href="https://www.tiktok.com/@hpciabidjan.sarl" target="_blank" title="TikTok" class="sc-tiktok"><i class="fa-brands fa-tiktok"></i></a>
      <a href="https://wa.me/2250706046595" target="_blank" title="WhatsApp" class="sc-whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
    </div>
  </div>
</div>

<nav>
  <div class="nav-inner">
    <a href="./index.php" class="logo">
      <img src="./images/logo/logo-hpci.png" alt="HPCI-SARL" style="height:48px;">
    </a>
    <ul class="nav-links">
      <li><a href="./index.php" class="active">Accueil</a></li>
      <li>
        <a href="pages/a-propos.php">Qui sommes-nous ? ▾</a>
        <div class="dropdown">
          <a href="pages/a-propos.php">À propos de nous</a>
          <a href="pages/equipe.php">Notre équipe</a>
        </div>
      </li>
      <li>
        <a href="pages/services.php">Nos services ▾</a>
        <div class="dropdown">
          <a href="pages/service-nettoyage-industriel.php"><i class="fa-solid fa-industry"></i> Nettoyage industriel</a>
          <a href="pages/service-maintenance.php"><i class="fa-solid fa-gears"></i> Maintenance industrielle</a>
        </div>
      </li>
      <li><a href="pages/actualite.php">Actualité</a></li>
      <li><a href="pages/contact.html" class="nav-cta">Nous contacter</a></li>
    </ul>
  </div>
</nav>


<section class="hero-slider">
  <div class="hero-slides">
    <!-- SLIDE 1: MAIN -->
    <div class="hero-slide active">
      <div class="slide-content">
        <span class="slide-badge">Expertise & Innovation depuis 2014</span>
        <h1 class="slide-title">L'Excellence du Nettoyage <span>Industriel & Professionnel</span></h1>
        <p class="slide-desc">Leader panafricain de l'hygiène industrielle, HPCI-SARL déploie des solutions de pointe pour la maintenance, l'assainissement et la sécurité de vos installations les plus critiques.</p>
        <div class="slide-cta">
          <a href="pages/services.php" class="btn-slider">Nos solutions techniques <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="slide-visual">
        <img src="./images/hero/hero-principal.png" alt="Nettoyage Industriel">
      </div>
    </div>

    <!-- SLIDE 2: PHYTO -->
    <div class="hero-slide">
      <div class="slide-content">
        <span class="slide-badge">Hygiène Environnementale</span>
        <h1 class="slide-title">Traitement phytosanitaire et <span>assainissement</span></h1>
        <p class="slide-desc">Méthodes spécifiques utilisées pour éliminer les organismes nuisibles et maintenir un environnement sain, tout en préservant la biodiversité.</p>
        <div class="slide-cta">
          <a href="pages/services.php" class="btn-slider">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="slide-visual">
        <img src="./images/services/phyto.jpg" alt="Traitement Phytosanitaire">
      </div>
    </div>

    <!-- SLIDE 3: HSE -->
    <div class="hero-slide">
      <div class="slide-content">
        <span class="slide-badge">Qualité, Hygiène, Sécurité & Environnement</span>
        <h1 class="slide-title">Mise à disposition du <span>personnel HSE</span></h1>
        <p class="slide-desc">Fourniture de professionnels en santé, sécurité et environnement pour garantir la conformité réglementaire et la gestion des risques.</p>
        <div class="slide-cta">
          <a href="pages/services.php" class="btn-slider">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="slide-visual">
        <img src="./images/services/HSE.jpg" alt="Personnel HSE">
      </div>
    </div>

    <!-- SLIDE 4: ENGINEERING -->
    <div class="hero-slide">
      <div class="slide-content">
        <span class="slide-badge">Bureau d'études & Engineering</span>
        <h1 class="slide-title">Engineering : <span>Conception & Optimisation</span></h1>
        <p class="slide-desc">L’ingénierie est une discipline qui englobe la conception, la réalisation et l’optimisation de systèmes techniques, industriels ou mécaniques.</p>
        <div class="slide-cta">
          <a href="pages/services.php" class="btn-slider">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="slide-visual">
        <img src="./images/services/maintenance-industrielle.jpg" alt="Engineering HPCI">
      </div>
    </div>
  </div>

  <div class="hero-dots"></div>
</section>

<!-- SECTIONS (Simplifiées pour le walkthrough) -->
<section class="testimonials anim">
  <div class="testimonials-visual"></div>
  <div class="testimonials-content">
    <h2>Ce que disent nos clients</h2>
    <div class="testimonials-slider">
      <div class="testimonials-track" id="testimonialTrack">
        <div class="testimonial-slide">
          <p class="testimonials-text">"Impeccable, délais respectés, qualité exceptionnelle."</p>
          <div class="testimonial-user">
            <div class="testimonial-avatar"><img src="./images/equipe/user.jpg" alt="Konan Marcel"></div>
            <div><h4>Konan Marcel</h4><p>Cadre de banque</p></div>
          </div>
        </div>
        <div class="testimonial-slide">
          <p class="testimonials-text">"Professionnalisme exceptionnel, réponses rapides, satisfaction totale."</p>
          <div class="testimonial-user">
            <div class="testimonial-avatar"><img src="./images/equipe/user.jpg" alt="Koua Désiré"></div>
            <div><h4>Koua Désiré</h4><p>Informaticien</p></div>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-nav">
      <div class="dot active" onclick="gotoSlide(0)"></div>
      <div class="dot" onclick="gotoSlide(1)"></div>
    </div>
  </div>
</section>

<section class="partners-section">
  <div class="container">
    <h2>Nos Partenaires</h2>
    <div class="partners-marquee">
      <div class="partners-track">
        <a href="https://www.mucodec.com/" target="_blank" class="partner-item"><img src="./images/partenaires/mucodec.png" alt="MUCODEC"></a>
        <a href="http://groupendounafrancois.com/" target="_blank" class="partner-item"><img src="./images/partenaires/ndouna.png" alt="GROUPE NDOUNA FRANCOIS"></a>
        <a href="https://www.eni.com/" target="_blank" class="partner-item"><img src="./images/partenaires/eni.png" alt="ENI"></a>
        <a href="http://www.coraf.cg/" target="_blank" class="partner-item"><img src="./images/partenaires/coraf.png" alt="CORAF"></a>
        <a href="http://www.cec-congo.com/" target="_blank" class="partner-item"><img src="./images/partenaires/cec.png" alt="CEC"></a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="footer-grid container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; padding: 60px 20px;">
    <div>
      <img src="./images/logo/logo-hpci.png" alt="Logo" style="height: 40px; margin-bottom: 20px;">
      <p style="font-size: 0.9rem; color: #64748b;">Hygiène Prodige Com International — Expert en solutions industrielles.</p>
      <div class="footer-social" style="margin-top: 20px; display: flex; gap: 15px;">
        <a href="https://www.facebook.com/profile.php?id=61565882327789" target="_blank" class="sc-facebook"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://www.linkedin.com/company/hpci-abidjansarl/" target="_blank" class="sc-linkedin"><i class="fa-brands fa-linkedin"></i></a>
        <a href="https://wa.me/2250706046595" target="_blank" class="sc-whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>
    <div>
      <h4 style="font-family: 'Barlow Condensed', sans-serif; margin-bottom: 20px;">Navigation</h4>
      <ul style="list-style: none; font-size: 0.9rem; line-height: 2;">
        <li><a href="index.php" style="text-decoration: none; color: inherit;">Accueil</a></li>
        <li><a href="pages/services.php" style="text-decoration: none; color: inherit;">Services</a></li>
        <li><a href="pages/actualite.php" style="text-decoration: none; color: inherit;">Actualité</a></li>
      </ul>
    </div>
    <div>
      <h4 style="font-family: 'Barlow Condensed', sans-serif; margin-bottom: 20px;">Contact</h4>
      <ul style="list-style: none; font-size: 0.9rem; line-height: 2; color: #64748b;">
        <li><i class="fa-solid fa-location-dot" style="color: var(--accent);"></i> Pointe-Noire, Congo</li>
        <li><i class="fa-solid fa-phone" style="color: var(--accent);"></i> +242 06 665 27 28</li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2024 HPCI-SARL — Hygiène Prodige Com International.</p>
  </div>
</footer>

<script>
  function gotoSlide(n) {
    const track = document.getElementById('testimonialTrack');
    const dots = document.querySelectorAll('.dot');
    track.style.transform = `translateX(-${n * 100}%)`;
    dots.forEach((dot, index) => dot.classList.toggle('active', index === n));
  }
</script>
</body>
</html>
