$files = Get-ChildItem -Path "c:\wamp64\www\hpci\pages" -Filter "*.html" | 
    Where-Object { $_.Name -ne 'a-propos.html' -and $_.Name -ne 'contact.html' }

foreach ($f in $files) {
    $content = Get-Content $f.FullName -Raw -Encoding UTF8

    # 1. Add Font Awesome if missing
    if ($content -notmatch 'font-awesome') {
        $content = $content -replace '(<link rel="stylesheet" href="\.\./style\.css">)', '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">' + "`n" + '<link rel="stylesheet" href="../style.css">'
    }

    # 2. Fix old page-hero structure: remove page-hero-pattern and page-hero-bar divs
    $content = $content -replace '<div class="page-hero-bg"></div><div class="page-hero-pattern"></div><div class="page-hero-bar"></div>', '<div class="page-hero-bg"></div>'

    # 3. Replace old breadcrumb separator
    $content = $content -replace '<span>›</span>', '<span class="breadcrumb-sep">/</span>'

    # 4. Replace Barlow Condensed font references in inline CSS
    $content = $content -replace "font-family:\s*'Barlow Condensed',\s*sans-serif", "font-family:'Outfit',sans-serif"
    $content = $content -replace "font-family:\s*'Barlow',\s*sans-serif", "font-family:'Outfit',sans-serif"

    # 5. Replace old color variable references in inline CSS
    $content = $content -replace 'var\(--accent\)', 'var(--red)'
    $content = $content -replace 'var\(--blue\)', 'var(--navy)'
    $content = $content -replace 'var\(--light\)', 'var(--off-white)'

    # 6. Fix old border-radius values in inline styles (8px -> 2px for cards)
    $content = $content -replace 'border-radius:\s*8px', 'border-radius: 2px'
    $content = $content -replace 'border-radius:\s*12px', 'border-radius: 2px'

    # 7. Replace old section-label with section-eyebrow where it precedes h2
    # (only in page content, not page-hero breadcrumbs)

    # 8. Add page-hero-accent bar if page-hero section found but no accent div
    if ($content -match 'class="page-hero"' -and $content -notmatch 'page-hero-accent') {
        $content = $content -replace '</div>\s*</section>\s*(\r?\n\s*<section)', "</div>`n  <div class=`"page-hero-accent`"></div>`n</section>`n`n  <section"
    }

    Set-Content $f.FullName -Value $content -Encoding UTF8
    Write-Host "Updated: $($f.Name)"
}
Write-Host "All pages updated."
