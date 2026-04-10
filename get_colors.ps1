Add-Type -AssemblyName System.Drawing
$img = [System.Drawing.Image]::FromFile('c:\wamp64\www\hpci3\images\logo\logo-hpci.png')
$bmp = New-Object System.Drawing.Bitmap($img)
$colors = @{}
for($y=0; $y -lt $bmp.Height; $y+=2) {
    for($x=0; $x -lt $bmp.Width; $x+=2) {
        $p = $bmp.GetPixel($x,$y)
        if($p.A -gt 100) {
            $hex = "#{0:X2}{1:X2}{2:X2}" -f $p.R, $p.G, $p.B
            if (-not $colors.ContainsKey($hex)) {
                $colors[$hex] = 1
            } else {
                $colors[$hex]++
            }
        }
    }
}
$top = $colors.GetEnumerator() | Sort-Object Value -Descending | Select-Object -First 10
foreach ($c in $top) { Write-Host "$($c.Name): $($c.Value)" }
