# 🏠 Guesthouse App (Laravel + React)

Welcome to the **Guesthouse App**, a modern, modular platform for managing digital guestbooks for apartments, villas, and other short-term rentals. This app empowers property owners with full control over the guest experience—from check-in details and WiFi info to reviews and rules.

---

## ✨ Features

### 🔒 Admin Panel (Laravel)
- User registration & authentication
- Owner profile with photo, bio, mobile number, contact links (WhatsApp, Viber, etc.)
- Dashboard for creating and editing properties
- Dynamic content sections using `enabled_pages[]`:
  - Welcome
  - Check-in / Check-out
  - WiFi (network, password, description)
  - Amenities
  - Location (area, country, description, map)
  - Rules (dynamic list)
  - FAQs (dynamic list)
  - Transportation Info (Bus, Taxi, etc.)
  - Gallery Upload (up to 10 photos via Cloudinary)
  - Logo Upload (via Cloudinary)
  - Review Section (short description + external URL)
  - Settings (Primary/Secondary colors)

### 🌐 API (Laravel)
- JSON endpoint per property via slug:
  ```
  GET /api/property/{slug}
  ```
- Returns all enabled sections and values including:
  - Gallery image URLs
  - Logo URL
  - Owner info (name, photo, contacts)
  - Color settings

### 📱 Frontend App (React)
- Dynamic mobile-ready UI
- Sections shown based on `enabled_pages`
- Tabs, Icons, Branding based on API
- Support for social media/contact actions

---

## ⚙️ Installation

### 1. Clone the repository
```bash
git clone https://github.com/your-user/guesthouse-app.git
cd guesthouse-app
```

### 2. Install backend dependencies
```bash
composer install
```

### 3. Install frontend (optional)
```bash
npm install && npm run dev
```

### 4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Add Cloudinary credentials to `.env`
```
CLOUDINARY_CLOUD_NAME=your_cloud
CLOUDINARY_API_KEY=your_key
CLOUDINARY_API_SECRET=your_secret
```

### 6. Run migrations
```bash
php artisan migrate
```

### 7. (Optional) Seed data
```bash
php artisan db:seed
```

### 8. Serve the app
```bash
php artisan serve
```

---

## 🔗 Example API Response
```json
{
  "property": {
    "slug": "lias-apartment",
    "logo_url": "https://res.cloudinary.com/.../logo.png",
    "gallery": ["https://res.cloudinary.com/.../1.jpg"],
    "enabled_pages": ["welcome", "wifi", "review", "faq", "rules"],
    "wifi": {
      "network": "Lia-Wifi",
      "password": "12345678",
      "description": "Available in all rooms"
    },
    "review": {
      "description": "If you enjoyed your stay, please leave a review!",
      "url": "https://airbnb.com/review/xyz"
    },
    ...
  },
  "owner": {
    "name": "Nick Armenis",
    "photo": "https://res.cloudinary.com/.../profile.jpg",
    "contacts": [
      { "type": "email", "value": "armenisnick@gmail.com", "icon": "...", "url": "mailto:armenisnick@gmail.com" }
    ]
  }
}
```

---

## 🧑‍💻 Developer Info
**Nick Armenis**  
📧 armenisnick@gmail.com

---

Made with ❤️ for property owners who care about their guests.
