$pages = Get-ChildItem 'c:\wamp64\www\hpci\pages' -Filter '*.html' |
    Where-Object { $_.Name -ne 'a-propos.html' -and $_.Name -ne 'contact.html' }

foreach ($f in $pages) {
    $c = Get-Content $f.FullName -Raw -Encoding UTF8
    $changed = $false

    # Fix old page-hero-pattern / page-hero-bar divs (various surrounding whitespace combos)
    $patterns = @(
        '<div class="page-hero-bg"></div><div class="page-hero-pattern"></div><div class="page-hero-bar"></div>',
        '<div class="page-hero-bg"></div>' + [char]10 + '    <div class="page-hero-pattern"></div>' + [char]10 + '    <div class="page-hero-bar"></div>',
        '<div class="page-hero-bg"></div>' + [char]13 + [char]10 + '    <div class="page-hero-pattern"></div>' + [char]13 + [char]10 + '    <div class="page-hero-bar"></div>'
    )
    foreach ($pat in $patterns) {
        if ($c -match [regex]::Escape($pat)) {
            $c = $c.Replace($pat, '<div class="page-hero-bg"></div>')
            $changed = $true
        }
    }

    # Also use regex for any remaining pattern/bar divs
    if ($c -match 'page-hero-pattern|page-hero-bar') {
        $c = [regex]::Replace($c, '\s*<div class="page-hero-(?:pattern|bar)"></div>', '')
        $changed = $true
    }

    # Add page-hero-accent if missing and page-hero section exists
    if ($c -match 'class="page-hero"' -and $c -notmatch 'page-hero-accent') {
        # Insert after closing </div> of page-hero-inner, before </section>
        $c = [regex]::Replace($c, '(</div>\s*)(</section>)', '$1  <div class="page-hero-accent"></div>' + [System.Environment]::NewLine + '$2', [System.Text.RegularExpressions.RegexOptions]::RightToLeft, [System.TimeSpan]::FromSeconds(2))
        $changed = $true
    }

    # Fix sidebar-card border-radius (16px -> 2px for TotalEnergies style)
    if ($c -match 'sidebar-card') {
        $c = $c -replace '(\.sidebar-card\s*\{[^}]*border-radius:\s*)16px', '${1}2px'
        $c = $c -replace '(\.contact-sidebar\s*\{[^}]*border-radius:\s*)16px', '${1}2px'
        $changed = $true
    }

    # Fix service-main-img border-radius
    $c = $c -replace '(\.service-main-img\s*\{[^}]*border-radius:\s*)16px', '${1}2px'

    if ($changed) {
        Set-Content $f.FullName $c -Encoding UTF8
        Write-Host "Fixed: $($f.Name)"
    } else {
        Write-Host "No changes: $($f.Name)"
    }
}

Write-Host "All done."
