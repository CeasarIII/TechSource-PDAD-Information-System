# PowerShell script to reset demo state
# Usage:
# .\scripts\reset_demo.ps1

Write-Host "Resetting demo database state..." -ForegroundColor Yellow

php artisan migrate:fresh --force

Write-Host "Seeding PDAD registry..." -ForegroundColor Cyan
php artisan db:seed --class=PdadRegistrySeeder --force

Write-Host "Seeding sample employer and jobs..." -ForegroundColor Cyan
php artisan db:seed --class=SampleEmployerAndJobsSeeder --force

Write-Host "Seeding curated demo scenarios..." -ForegroundColor Cyan
php artisan db:seed --class=DemoScenarioSeeder --force

Write-Host ""
Write-Host "Demo state ready!" -ForegroundColor Green
Write-Host "Includes:" -ForegroundColor Cyan
Write-Host "- PDAD registry records"
Write-Host "- Sample employers and jobs"
Write-Host "- Curated demo employers and jobs"
Write-Host ""
Write-Host "Ready for demo run."