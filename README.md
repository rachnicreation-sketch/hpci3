# HPCI-SARL — Guide du Site Web

## Structure des fichiers

```
hpci-site/
├── index.html              ← Page d'accueil
├── style.css               ← Styles partagés (toutes les pages)
├── components.js           ← Navigation & Footer (injectés automatiquement)
├── pages/
│   ├── a-propos.html
│   ├── engagements.html
│   ├── equipe.html
│   ├── certifications.html
│   ├── services.html
│   ├── service-nettoyage-industriel.html  ← Modèle pour les autres services
│   ├── service-maintenance.html           ← À compléter (copier le modèle)
│   ├── service-nettoyage-pro.html         ← À compléter
│   ├── service-bio-nettoyage.html         ← À compléter
│   ├── service-phytosanitaire.html        ← À compléter
│   ├── service-hse.html                   ← À compléter
│   ├── service-engineering.html           ← À compléter
│   ├── mediatheque.html
│   ├── actualite.html
│   ├── partenaires.html
│   └── contact.html
└── images/
    ├── logo/               ← logo-hpci.png (recommandé: PNG transparent, hauteur 44-60px)
    ├── hero/               ← Images grandes (accueil, à-propos)
    ├── services/           ← Une photo par service (600×300px minimum)
    ├── equipe/             ← Photos de l'équipe (portrait carré 400×400px)
    ├── partenaires/        ← Logos partenaires (PNG transparent, 240×160px)
    ├── certifications/     ← Scans des certificats (600×440px)
    ├── mediatheque/        ← Photos galerie (800×600px)
    └── actualites/         ← Images articles (800×440px)
```

---

## Comment ajouter les images

### 1. Logo principal
Chercher dans le code : `<!-- ═══════════════════════════════════════════════ LOGO`
Remplacer :
```html
<div class="logo-mark">H</div>
```
Par :
```html
<img src="images/logo/logo-hpci.png" alt="HPCI-SARL" style="height:44px;">
```

### 2. Image Hero (accueil)
Chercher : `/* ═══ IMAGE HERO PRINCIPALE`
Remplacer le gradient par :
```css
background: url('images/hero/hero-principal.jpg') center/cover no-repeat;
```

### 3. Images de services
Chercher : `/* ═════ IMAGE : images/services/[nom-service].jpg ═════`
Remplacer le style inline par :
```html
<div class="service-thumb" style="background: url('../images/services/nettoyage-industriel.jpg') center/cover no-repeat;">
```
*(supprimer le `<span class="service-thumb-icon">` en dessous)*

### 4. Photos équipe
Chercher : `/* ═══════════════════════════════════════════════════════════ PHOTO MEMBRE D'ÉQUIPE`
Remplacer le background gradient par :
```html
<div class="team-photo" style="background: url('../images/equipe/jean-dupont.jpg') center top/cover no-repeat;"></div>
```

### 5. Logos partenaires
Chercher : `/* ═══ LOGO PARTENAIRE`
Remplacer `<div class="partner-logo-box">🤝</div>` par :
```html
<div class="partner-logo-box">
  <img src="../images/partenaires/nom-partenaire.png" alt="Nom" style="max-width:100%;max-height:100%;object-fit:contain;">
</div>
```

---

## Comment ajouter des pages de services manquantes

1. Copier `pages/service-nettoyage-industriel.html`
2. Renommer selon le service (ex: `service-maintenance.html`)
3. Modifier : `<title>`, `<h1>`, les textes, et les images
4. Changer `injectNav('nettoyage_ind')` par la clé correspondante :
   - maintenance → `injectNav('maintenance')`
   - nettoyage_pro → `injectNav('nettoyage_pro')`
   - bio_nettoyage → `injectNav('bio_nettoyage')`
   - phytosanitaire → `injectNav('phytosanitaire')`
   - hse → `injectNav('hse')`
   - engineering → `injectNav('engineering')`

---

## Comment ajouter un article d'actualité

Dans `pages/actualite.html`, dupliquer ce bloc :
```html
<div class="actu-card anim">
  <div class="actu-thumb" style="background:url('../images/actualites/mon-article.jpg') center/cover no-repeat;"></div>
  <div class="actu-body">
    <span class="actu-tag">Catégorie</span>
    <h3>Titre de l'article</h3>
    <p>Description courte de l'article en quelques phrases.</p>
    <div class="actu-footer">
      <span>📅 Mois Année</span>
      <a href="#">Lire l'article →</a>
    </div>
  </div>
</div>
```

---

## Contacts et couleurs

Pour modifier les couleurs du site, éditer dans `style.css` :
```css
:root {
  --navy:   #0a1628;   /* Bleu très foncé (navbar, footer, hero) */
  --blue:   #1a4480;   /* Bleu principal */
  --accent: #e8a020;   /* Doré/Orange (boutons, accents) */
  --green:  #2d8b57;   /* Vert (checkmarks) */
}
```
