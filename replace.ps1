$files = Get-ChildItem -Path "c:\wamp64\www\hpci3\pages\*.html"
foreach ($file in $files) {
    if ($file.Name -match "\.html$") {
        $content = Get-Content $file.FullName -Raw
        $newContent = $content -replace ">(Nous contacter \?|Contactez-nous \?|Demander un devis \?|Nous consulter \?)</a>", ">En savoir plus <i class=`"fa-solid fa-arrow-right`"></i></a>"
        if ($content -ne $newContent) {
            Set-Content $file.FullName $newContent -Encoding UTF8
            Write-Host "Updated $($file.Name)"
        }
    }
}
