# Auto-clear Laravel caches script
# Usage: .\clear-caches.ps1

Write-Host "🧹 Clearing Laravel caches..." -ForegroundColor Cyan

cd "c:\laragon\www\alumni system"

$php = "C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe"

Write-Host "  - Clearing config..." -ForegroundColor Yellow
& $php artisan config:clear

Write-Host "  - Clearing application cache..." -ForegroundColor Yellow
& $php artisan cache:clear

Write-Host "  - Clearing compiled views..." -ForegroundColor Yellow
& $php artisan view:clear

Write-Host "  - Clearing routes..." -ForegroundColor Yellow
& $php artisan route:clear

Write-Host "`n✅ All caches cleared!" -ForegroundColor Green
Write-Host "💡 Refresh your browser to see changes." -ForegroundColor Cyan
