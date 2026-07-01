# PowerShell script to backup PDAD Database
# Usage:
# .\scripts\backup_database.ps1

param(
    [string]$BackupDir = ".\backups",
    [string]$DbName = "pdad_db",
    [string]$MysqlPath = "C:\xampp\mysql\bin"
)

# Create backup folder if it doesn't exist
if (!(Test-Path $BackupDir)) {
    New-Item -ItemType Directory -Path $BackupDir | Out-Null
    Write-Host "Created backup directory: $BackupDir"
}

# Timestamp
$timestamp = Get-Date -Format "yyyy-MM-dd_HHmmss"

$filename = "$DbName`_$timestamp.sql"

$fullPath = Join-Path $BackupDir $filename

Write-Host "Backing up database..."

& "$MysqlPath\mysqldump.exe" `
    -u root `
    --databases $DbName `
    > $fullPath

if (Test-Path $fullPath) {

    $size = (Get-Item $fullPath).Length / 1MB

    Write-Host ""
    Write-Host "Backup Successful!" -ForegroundColor Green
    Write-Host ("Backup Size : {0:N2} MB" -f $size)
    Write-Host "Location     : $fullPath"

    # Keep only last 7 days
    Get-ChildItem $BackupDir -Filter "*.sql" |
        Where-Object { $_.CreationTime -lt (Get-Date).AddDays(-7) } |
        Remove-Item -Force

}
else {

    Write-Host "Backup Failed!" -ForegroundColor Red

}   