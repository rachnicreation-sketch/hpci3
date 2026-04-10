# Script de localisation des images pour HPCI-SARL
# Ce script télécharge les images officielles et les place dans les dossiers locaux du projet.

$images = @{
    "images/hero/sld1.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/01/sld1.jpg"
    "images/hero/qhse.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/08/HPCI-POM1-04-POLITIQUE-QHSE-DD-24.jpg"
    "images/services/nettoyage-industrielle.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/nettoyage-industrielle.jpg"
    "images/services/maintenance-industrielle.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/maintenance-industrielle.jpg"
    "images/services/nettoyage-pro.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/nettoyage-pro.jpg"
    "images/services/nettoyage-bio.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/nettoyage-bio.jpg"
    "images/services/phyto.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/phyto.jpg"
    "images/services/HSE.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/HSE.jpg"
    "images/services/engineering.jpg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/01/64ef658c00a8b-ouvrier15-hpci-nettoyage-industriel-abidjan-cote-ivoire.jpg"
    "images/partenaires/mucodec.png" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/mucodec.png"
    "images/partenaires/ndouna.png" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/ndouna.png"
    "images/partenaires/eni.png" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/eni.png"
    "images/partenaires/coraf.png" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/coraf.png"
    "images/partenaires/cec.png" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/cec.png"
    "images/equipe/dh-hpci.jpeg" = "https://www.hpci-sarl.net/wp-content/uploads/2024/02/dh-hpci.jpeg"
}

Write-Host "Démarrage du téléchargement des assets..." -ForegroundColor Cyan

foreach ($path in $images.Keys) {
    $url = $images[$path]
    $dir = Split-Path -Path $path
    if (!(Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
    }
    
    Write-Host "Téléchargement : $path..."
    try {
        Invoke-WebRequest -Uri $url -OutFile $path -ErrorAction Stop
    } catch {
        Write-Host "Erreur lors du téléchargement de $path" -ForegroundColor Red
    }
}

Write-Host "Terminé ! Toutes les images sont maintenant locales." -ForegroundColor Green
