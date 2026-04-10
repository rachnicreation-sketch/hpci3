/* ============================================================
   HPCI-SARL — Composants partagés (topbar + nav + footer)
   Refonte style TotalEnergies
   Usage : <script src="../components.js"></script>
           injectNav('accueil'); injectFooter();
   ============================================================ */

/* ── TOPBAR REMOVED ── *//* ── NAV ── */
function injectNav(activePage) {
  const root = document.body.dataset.root || './';

  const p = {
    accueil:        root + 'index.html',
    apropos:        root + 'pages/a-propos.html',
    engagements:    root + 'pages/engagements.html',
    equipe:         root + 'pages/equipe.html',
    certifications: root + 'pages/certifications.html',
    services:       root + 'pages/services.html',
    nettoyage_ind:  root + 'pages/service-nettoyage-industriel.html',
    maintenance:    root + 'pages/service-maintenance.html',
    nettoyage_pro:  root + 'pages/service-nettoyage-pro.html',
    bio_nettoyage:  root + 'pages/service-bio-nettoyage.html',
    phytosanitaire: root + 'pages/service-phytosanitaire.html',
    hse:            root + 'pages/service-hse.html',
    engineering:    root + 'pages/service-engineering.html',
    mediatheque:    root + 'pages/mediatheque.html',
    actualite:      root + 'pages/actualite.html',
    partenaires:    root + 'pages/partenaires.html',
    contact:        root + 'pages/contact.html',
  };

  const isAbout    = ['apropos','engagements','equipe','certifications'].includes(activePage);
  const isServices = activePage === 'services' || activePage.startsWith('service');

  document.body.insertAdjacentHTML('afterbegin', `    <nav id="mainNav">
      <div class="nav-inner">
        <a href="${p.accueil}" class="logo">
          <img src="${root}images/logo/logo-hpci.png" alt="HPCI-SARL" style="height:56px;">
        </a>

        <ul class="nav-links" id="navLinks">
          <li><a href="${p.accueil}" class="${activePage === 'accueil' ? 'active' : ''}">Accueil</a></li>

          <li>
            <a href="${p.apropos}" class="${isAbout ? 'active' : ''}">Qui sommes-nous ?</a>
            <div class="dropdown">
              <a href="${p.apropos}">À propos de nous</a>
              <a href="${p.engagements}">Nos engagements</a>
              <a href="${p.equipe}">Notre équipe</a>
              <a href="${p.certifications}">Nos certifications</a>
            </div>
          </li>

          <li>
            <a href="${p.services}" class="${isServices ? 'active' : ''}">Nos services</a>
            <div class="dropdown">
              <a href="${p.nettoyage_ind}">Nettoyage industriel</a>
              <a href="${p.maintenance}">Maintenance industrielle</a>
              <a href="${p.nettoyage_pro}">Nettoyage professionnel</a>
              <a href="${p.bio_nettoyage}">Bio nettoyage hospitalier</a>
              <a href="${p.phytosanitaire}">Traitement phytosanitaire</a>
              <a href="${p.hse}">Personnel HSE</a>
              <a href="${p.engineering}">Engineering</a>
            </div>
          </li>

          <li><a href="${p.mediatheque}" class="${activePage === 'mediatheque' ? 'active' : ''}">Médiathèque</a></li>
          <li><a href="${p.actualite}" class="${activePage === 'actualite' ? 'active' : ''}">Actualité</a></li>
          <li><a href="${p.partenaires}" class="${activePage === 'partenaires' ? 'active' : ''}">Partenaires</a></li>
          <li><a href="${p.contact}" class="nav-cta ${activePage === 'contact' ? 'active' : ''}">Nous contacter</a></li>
        </ul>

        <button class="hamburger" id="hamburgerBtn" onclick="toggleMobileMenu()" aria-label="Menu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </nav>
  `);

  /* Nav scroll shadow */
  window.addEventListener('scroll', () => {
    const nav = document.getElementById('mainNav');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 20);
  });
}

/* ── FOOTER ── */
function injectFooter() {
  const root = document.body.dataset.root || './';

  document.body.insertAdjacentHTML('beforeend', `
    <div class="cta-band">
      <div class="cta-band-inner">
        <div class="cta-text">
          <h2>Prêt à travailler avec nous ?</h2>
          <p>Contactez-nous dès aujourd'hui pour un devis personnalisé et gratuit.</p>
        </div>
        <a href="${root}pages/contact.html" class="cta-btn">Demander un devis <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>

    <footer>
      <div class="footer-grid">

        <div class="footer-brand">
          <a href="${root}index.html" class="footer-logo">
            <img src="${root}images/logo/logo-hpci.png" alt="HPCI-SARL" style="height:52px; border-radius:2px; background: white; padding: 4px;">
          </a>
          <p>Hygiène Prodige Com International — Spécialiste du nettoyage industriel, de la maintenance et de l'assainissement en Afrique centrale et de l'Ouest.</p>
          <div class="footer-social">
            <a href="https://www.facebook.com/profile.php?id=61565882327789" target="_blank" aria-label="Facebook" class="sc-facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/company/hpci-abidjansarl/" target="_blank" aria-label="LinkedIn" class="sc-linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="http://www.tiktok.com/@hpciabidjan.sarl" target="_blank" aria-label="TikTok" class="sc-tiktok"><i class="fa-brands fa-tiktok"></i></a>
            <a href="http://wa.me/2250706046595" target="_blank" aria-label="WhatsApp" class="sc-whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <div class="footer-col">
          <h4>Qui sommes-nous</h4>
          <ul>
            <li><a href="${root}pages/a-propos.html">À propos de nous</a></li>
            <li><a href="${root}pages/engagements.html">Nos engagements</a></li>
            <li><a href="${root}pages/equipe.html">Notre équipe</a></li>
            <li><a href="${root}pages/certifications.html">Nos certifications</a></li>
            <li><a href="${root}pages/partenaires.html">Nos partenaires</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Nos services</h4>
          <ul>
            <li><a href="${root}pages/service-nettoyage-industriel.html">Nettoyage industriel</a></li>
            <li><a href="${root}pages/service-maintenance.html">Maintenance industrielle</a></li>
            <li><a href="${root}pages/service-nettoyage-pro.html">Nettoyage professionnel</a></li>
            <li><a href="${root}pages/service-bio-nettoyage.html">Bio nettoyage</a></li>
            <li><a href="${root}pages/service-phytosanitaire.html">Traitement phytosanitaire</a></li>
            <li><a href="${root}pages/service-hse.html">Personnel HSE</a></li>
            <li><a href="${root}pages/service-engineering.html">Engineering</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Nos implantations</h4>
          <div class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>
              <strong style="color:rgba(255,255,255,0.6);">Abidjan (Siège)</strong><br>
              Côte d'Ivoire<br>
              <a href="tel:+2252722240247">+225 27 222 402 47</a>
            </span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>
              <strong style="color:rgba(255,255,255,0.6);">Pointe-Noire</strong><br>
              République du Congo<br>
              <a href="tel:+242066652728">+242 066 652 728</a>
            </span>
          </div>
          <div class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span>
              <strong style="color:rgba(255,255,255,0.6);">Brazzaville</strong><br>
              République du Congo<br>
              <a href="tel:+242057911680">+242 05 791 16 80</a>
            </span>
          </div>
        </div>

      </div>

      <div class="footer-bottom">
        <p>© 2024 HPCI-SARL — Hygiène Prodige Com International. Tous droits réservés.</p>
        <div class="footer-bottom-links">
          <a href="#">Mentions légales</a>
          <a href="#">Politique de confidentialité</a>
          <a href="${root}pages/contact.html">Contact</a>
        </div>
      </div>
    </footer>
  `);
}

/* ── MOBILE MENU ── */
function toggleMobileMenu() {
  const links = document.getElementById('navLinks');
  if (!links) return;
  const isOpen = links.classList.toggle('mobile-open');
  links.style.display = isOpen ? 'flex' : '';

  /* Animate hamburger */
  const btn = document.getElementById('hamburgerBtn');
  if (btn) btn.classList.toggle('is-open', isOpen);
}

/* ── SCROLL ANIMATIONS ── */
function initAnimations() {
  const els = document.querySelectorAll('.anim');
  if (!els.length) return;
  const obs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        setTimeout(() => e.target.classList.add('visible'), i * 80);
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });
  els.forEach(el => obs.observe(el));
}

document.addEventListener('DOMContentLoaded', initAnimations);
