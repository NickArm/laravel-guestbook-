# Guesthouse App (Laravel + React)

Welcome to the **Guesthouse App**, a modern Laravel-based admin panel paired with a React-powered frontend.
This platform empowers property owners to create and manage digital guestbooks with rich content and customized appearance.

---

## ✨ Features

### 🛠 Admin Panel (Laravel)
- Authenticated dashboard for each property owner
- Dynamic section toggling via `enabled_pages`
- Full CRUD support for:
  - Rules (title, description)
  - FAQs (question, answer)
  - WiFi (network, password, description)
  - Transportation (title, description)
  - Image Gallery (up to 10 images per property)
  - Property Logo (via Cloudinary)
  - Owner Profile & Contact Info
- Settings per property:
  - Primary Color
  - Secondary Color

### 📱 Frontend (React)
- Dynamic display of sections based on API data
- Slug-based access (e.g. `https://app.welcomy.net/api/property/my-house`)
- Modern and responsive design
- Easy-to-integrate JSON-based content loading

---

## 🔌 Cloudinary Integration
- Optimized image storage (logo, gallery)
- Image deletion supported from UI + Cloudinary
- All uploads organized under folders per property:
  - `properties/{slug}/logo`
  - `properties/{slug}/gallery`

---

## ⚙️ Installation

```bash
git clone https://github.com/your-user/guesthouse-app.git
cd guesthouse-app
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```

---

## 🗃 Database Setup

```bash
php artisan migrate
php artisan db:seed # Optional for demo data
```

---

## ▶️ Run the App

```bash
php artisan serve
```

---

## 🔗 API

**Property JSON Endpoint**

```
GET /api/property/{slug}
```

Returns:
```json
{
  "property": {
    "name": "Lia's Apartment",
    "slug": "lias-apartment",
    "logo_url": "...",
    "gallery": ["...", "..."],
    "enabled_pages": ["wifi", "faq", "rules"],
    "checkin": "...",
    "wifi": {
      "network": "...",
      "password": "...",
      "description": "..."
    },
    "settings": {
      "primary_color": "#000000",
      "secondary_color": "#ffffff"
    },
    "owner": {
      "name": "...",
      "photo": "...",
      "contacts": [...]
    }
  }
}
```

---

## 👨‍💻 Developer Info

**Nick Armenis**  
📧 armenisnick@gmail.com

Made with ❤️ for digital guest experience.
