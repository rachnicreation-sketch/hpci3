$fa = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">'
$cssLink = '<link rel="stylesheet" href="../style.css">'

$pages = Get-ChildItem 'c:\wamp64\www\hpci\pages' -Filter '*.html' |
    Where-Object { $_.Name -ne 'a-propos.html' -and $_.Name -ne 'contact.html' }

foreach ($f in $pages) {
    $c = Get-Content $f.FullName -Raw -Encoding UTF8
    if ($c -notmatch 'font-awesome') {
        $newCssBlock = $fa + [System.Environment]::NewLine + $cssLink
        $c = $c.Replace($cssLink, $newCssBlock)
        Set-Content $f.FullName $c -Encoding UTF8
        Write-Host "FA added: $($f.Name)"
    } else {
        Write-Host "Already has FA: $($f.Name)"
    }
}

Write-Host "Done."
