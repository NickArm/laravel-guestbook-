## v0.8.5 (2025-06-23)
- Several Design Fixes (https://github.com/NickArm/laravel-guestbook-/commit/111f769c55a8eaeda61f191117841d8fcd5b8c6c)
- Added URL at Transportation Section (https://github.com/NickArm/laravel-guestbook-/commit/afee382796249d663daf0a3fb0b8916512399312)

## v0.8.4 (2025-06-17)
### Added
- Review section toggle added: Admins can now enable/disable the Review section via switch, affecting the enabled_pages array.
- Redesigned ReviewSection UI with improved input styling and layout.
- AppliancePage now displays "More Appliances" section below the selected appliance.
- Bottom navigation active highlighting removed for simplified styling.
- Appliance button list redesigned with primary color border and arrow icon to indicate interactivity.

### Fixed / Improved
- Fixed missing bottom navigation bar display on certain routes.
- PWA manifest updated to include complete icon set from public/icons for broader device compatibility.
- App logo issues resolved with better handling of logo path and Cloudinary optimization.
- General UI spacing and structure improvements across property sections.

## v0.8.3 (2025-06-16)

### ✨ Added
- GetYourGuide Widget Integration: Admins can now paste and manage GYG widget embed code via Settings. The widget is rendered dynamically in the frontend.
- Blog URL field added to Property Settings. Frontend BlogPage now fetches posts dynamically via API. 
- Blog section is now toggleable via enabled_pages array.

### 🛠 Fixed / Improved
- Refactored SettingsSection UI to include GetYourGuide and Blog controls in their own blocks
- API response now includes `gyg_widget_code`, `blog.enabled`, `blog.url`
- Merged branch `feature/GetYourGuide` and `feature/Blog_Feature` into `develop`

---

## v0.8.2 (2025-06-13)

### ✨ Added
- Unified support for uploading Property Logo to Cloudinary
- Settings model now stores and exposes logo_url
- Color Picker inputs (Primary/Secondary) with Tailwind integration in Settings UI

### 🛠 Fixed
- Logo removal functionality now fully clears logo_url and deletes from Cloudinary
- Settings validation errors now render under each field

---

## v0.8.1 (2025-06-09)

### ✨ Added
- Livewire: Added section-based editing support (WiFi, Rules, FAQ, Review, Before You Go, Transportation)
- API expanded to support: amenities_description, location_area, google_map_url, contact_me array, and property gallery
- Recommendations are now linked to each property (many-to-many)

### 🛠 Fixed
- Various API formatting issues (e.g. WiFi null fallback)
- Review URL handling edge cases
- Added new migrations: review, faq, rules, transportation, settings

---

## v0.8.0 (2025-06-03)

### 🚀 Initial Full Admin UI and API Rework
- Properties CRUD complete with gallery images and Cloudinary upload support
- Dynamic enabled_pages control which toggles frontend content sections
- First public-ready JSON API for frontend consumption based on slug (e.g. `/api/property/mantouki`)
- Responsive Livewire admin panel based on Metronic layout

### ✅ Foundation Set
- Laravel 10 setup with Jetstream + Livewire
- Custom dashboard
- User registration, profile photo, password update

---
