# 📅 Doistichat — Team Meetings & Email Reminders

A lightweight PHP web app for teams to:
- ✅ Schedule & join meetings (via Jitsi/Zoom-style links)  
- ✅ Set automatic email reminders (e.g., 15 minutes before)  
- ✅ Stay synced without heavy tools

Built for simplicity, privacy, and self-hosting.

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?logo=sqlite)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap)

---

## 🚀 Features

- 🔐 User signup & login  
- 📅 Create meetings with title, time, duration  
- 🔗 Auto-generated Jitsi join links  
- ⏰ Automatic email reminders (CLI cron job)  
- 📧 Email notifications via PHPMailer (Gmail, SMTP, etc.)

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 8+ (procedural, no framework) |
| Database | SQLite (zero setup) |
| Frontend | Bootstrap 5 + Vanilla JS |
| Email | PHPMailer + SMTP |
| Deployment | Shared hosting, VPS, or local dev |

---

## 📦 Quick Setup (Local Dev)

### Prerequisites
- PHP 8.0+ (with `pdo_sqlite`, `openssl` enabled)  
- Composer (for PHPMailer)  
- Git (optional)

### Steps
```bash
# 1. Clone or download this repo
git clone https://github.com/SanaUllah-Gondal/meetings.git
cd meetings

# 2. Install dependencies
composer require phpmailer/phpmailer

# 3. Configure email (update config.php)
#    → Set MAIL_USERNAME, MAIL_PASSWORD (use Gmail App Password)

# 4. Start dev server
php -S localhost:8000

# 5. Open in browser
http://localhost:8000
