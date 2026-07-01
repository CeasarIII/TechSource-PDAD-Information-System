# Database Backup and Restore Guide

## Creating a Backup

Export the database using phpMyAdmin:

1. Open phpMyAdmin.
2. Select the `pdad_db` database.
3. Click the **Export** tab.
4. Choose **Quick** export.
5. Select SQL format.
6. Click **Go**.

---

## Restoring a Backup

1. Create an empty database named `pdad_db`.
2. Open phpMyAdmin.
3. Select the database.
4. Click **Import**.
5. Select the SQL backup file.
6. Click **Go**.

---

## Laravel Migration Recovery

Run:

```bash
php artisan migrate
```

If seeders are needed:

```bash
php artisan db:seed
```

Or:

```bash
php artisan migrate:fresh --seed
```

---

## Important Notes

- Backup before major schema updates.
- Verify migration status before deployment.
- Store backups securely.
- Test restore procedures regularly.

---

## Recovery Checklist

- Restore SQL backup.
- Run pending migrations.
- Seed required reference data.
- Verify application functionality.

---

# Automated Backup (PowerShell)

Run manually:

```powershell
.\scripts\backup_database.ps1
```

The script will:

- Create the backup folder automatically.
- Generate a timestamped SQL backup.
- Keep only the last 7 days of backups.
- Delete older backup files automatically.

## Scheduling (Windows Task Scheduler)

1. Open **Task Scheduler**.
2. Create a Basic Task.
3. Name: **PDAD Database Backup**
4. Trigger: **Daily**
5. Action: **Start a Program**
6. Program:

```
powershell.exe
```

7. Arguments:

```
-ExecutionPolicy Bypass -File "<Project Folder>\scripts\backup_database.ps1"
```