# Welcomy Guesthouse Management System

This Laravel + Tailwind + Alpine.js based web app allows guesthouse owners and superadmins to manage properties, users, and content in a user-friendly dashboard.

---

## Features

### ✅ User Roles
- Superadmin:
  - Manage users (create, edit, deactivate)
  - See all properties
- User:
  - Manage only their own properties

### 🏡 Property Management
- CRUD operations for properties
- Supports multiple optional sections:
  - Rules
  - FAQs
  - Amenities
  - Transportation
  - Review
  - WiFi settings
- Image upload via Cloudinary:
  - Logo (1 image)
  - Gallery (up to 10 images)

### ⚙️ Settings
- Customize each property's primary/secondary colors
- Enable/disable content sections via checkboxes

### 📍 Location Support
- Stores location description, area, country, and Google Map URL

### 🔐 Authentication & Access Control
- Laravel Breeze-based auth (email & password)
- Role-based route protection via middleware

---

## Installation

```bash
git clone https://github.com/your-org/welcomy.git
cd welcomy

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed

npm install && npm run dev
php artisan serve
```

---

## Developer Notes

### Directory Structure

- `app/Services/PropertyService.php`: main service layer for creating/updating properties
- `app/Actions/UploadLogoAction.php`: Cloudinary logo handler
- `app/Actions/UploadGalleryImagesAction.php`: Gallery image uploader with limit check
- `app/Http/Controllers/PropertyController.php`: Injects services and handles authorization
- `resources/views/properties`: Blade views with dynamic UI

### Middleware

- `is_superadmin`: custom middleware to restrict admin routes
- `'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class` for permission checks

### Cloudinary

Ensure `.env` has:
```
CLOUDINARY_CLOUD_NAME=...
CLOUDINARY_API_KEY=...
CLOUDINARY_API_SECRET=...
```

---

## Future Improvements

- [ ] Refactor validation to use Form Requests everywhere
- [ ] Move Settings, Review, and Image uploads to dedicated actions/services
- [ ] Add activity logs for Superadmin (e.g. user created/deleted)
- [ ] Enable bulk import/export of property data (CSV/Excel)
- [ ] Add unit and feature tests

---

## License

MIT
