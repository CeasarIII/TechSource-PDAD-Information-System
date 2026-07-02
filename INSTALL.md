# TechSource PDAD Information System

## Installation Guide

This guide explains how to set up the TechSource PDAD Information System on a new development machine.

---

# Prerequisites

Install the following software before starting:

- XAMPP (Apache + MySQL)
- PHP 8.4 or later
- Composer
- Node.js (18 or later)
- npm
- Python 3.10 or later
- Git

---

# 1. Clone the Repository

```powershell
git clone https://github.com/CeasarIII/TechSource-PDAD-Information-System.git
cd TechSource-PDAD-Information-System
```

---

# 2. Configure Environment

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdad_db
DB_USERNAME=root
DB_PASSWORD=
```

---

# 3. Create the Database

Open phpMyAdmin:

```
http://localhost/phpmyadmin
```

Create:

```sql
CREATE DATABASE pdad_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

---

# 4. Install Dependencies

```powershell
composer install

npm install

npm run build
```

---

# 5. Configure Python (Machine Learning)

```powershell
python -m venv .venv

.\.venv\Scripts\Activate.ps1

pip install pandas scikit-learn joblib mysql-connector-python
```

---

# 6. Run Database Migrations

```powershell
php artisan migrate
```

Verify:

```powershell
php artisan migrate:status
```

---

# 7. Seed the Database

PDAD Registry CSV is not included in Git.

Request the CSV file from the project maintainer and place it in:

```
database/seeders/data/
```

Then run:

```powershell
php artisan db:seed --class=PdadRegistrySeeder

php artisan db:seed --class=SampleEmployerAndJobsSeeder
```

For stress testing:

```powershell
php artisan db:seed --class=StressTestSeeder
```

---

# 8. Verify Installation

```powershell
php artisan tinker
```

```php
\App\Models\User::count();

DB::table('pwd_registry_reference')->count();

DB::table('job_posts')->count();

DB::table('employers')->count();

exit
```

---

# 9. Run the Application

```powershell
php artisan serve
```

Open:

```
http://127.0.0.1:8000
```

---

# Troubleshooting

## MySQL does not start

Stop any Windows MySQL service using port 3306.

Restart MySQL in XAMPP.

---

## Migration Error

If tables already exist:

```powershell
php artisan migrate:fresh
```

---

## Class Not Found

```powershell
composer dump-autoload
```

---

## Clear Laravel Cache

```powershell
php artisan config:clear

php artisan cache:clear

php artisan route:clear

php artisan view:clear
```

---

## Missing PDAD Registry CSV

The registry CSV is intentionally excluded from Git because it contains sensitive information.

Request the latest copy from the project administrator.

---

# Notes

- Follow migration order exactly.
- Never modify production data directly.
- Always backup the database before running destructive commands.
- Use Git pull with rebase before pushing changes.