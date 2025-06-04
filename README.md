
# Welcomy Guesthouse Management System

Το **Welcomy** είναι μια Laravel εφαρμογή διαχείρισης ψηφιακών βιβλίων επισκεπτών για ιδιοκτήτες καταλυμάτων. Κάθε χρήστης μπορεί να δημιουργήσει properties (ιδιοκτησίες) και να διαχειριστεί custom περιεχόμενο για τους επισκέπτες του.

---

## 🔧 Features

- User authentication (Login, Logout, Email verification)
- Διαφορετικά roles: `superadmin`, `user`
- Property management με:
  - Check-in/out πληροφορίες
  - Welcome messages, WiFi, location, amenities
  - Δυνατότητα Gallery εικόνων και review URLs
- Dashboard ανά χρήστη
- Πλήρες CRUD για properties
- Property limit ανά χρήστη
- Soft toggling ενεργών/ανενεργών χρηστών
- Ασφαλές API με ενεργούς χρήστες μόνο
- Contact form & FAQs page (static)
- Admin panel για διαχείριση χρηστών

---

## 🧪 Tech Stack

- Laravel 10.x
- PHP 8.1
- Tailwind CSS
- Cloudinary (για διαχείριση εικόνων)
- Spatie Laravel-Permission (Roles & Permissions)

---

## 🗂 Directory Overview

- `/app/Http/Controllers` — Χειριστές για user & property ροές
- `/resources/views` — Blade views (admin/user/frontend)
- `/routes/web.php` — Όλες οι routes της εφαρμογής
- `/database/seeders` — UserSeeder, RoleSeeder, DemoDataSeeder

---

## 🛠 Installation

```bash
git clone https://github.com/NickArm/welcomy.git
cd welcomy

composer install
cp .env.example .env
php artisan key:generate

# Configure DB & Cloudinary in .env

php artisan migrate --seed
php artisan serve
```

---

## 📌 Admin Credentials (dev only)

```
email: admin@guesthouse.com
password: password
```

---

## 🔐 Roles & Access

| Role        | Permissions                        |
|-------------|------------------------------------|
| Superadmin  | Manage all users & properties      |
| User        | Manage own properties              |

---

## ⚠️ Middleware

- `auth` — Laravel built-in authentication
- `is_superadmin` — Custom middleware for admin-only routes
- `active_user_only` — Custom middleware για API endpoints (μόνο ενεργοί χρήστες)

---

## 📈 Deployment Tips

- Χρησιμοποίησε Horizon για job queues (π.χ. emails)
- Cache routes/permissions σε production:
  ```bash
  php artisan route:cache
  php artisan config:cache
  php artisan view:cache
  ```

---

## 📮 Contact

Για υποστήριξη: support@welcomy.net
