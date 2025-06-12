# Welcomy Backend (Laravel)

This Laravel backend powers the Welcomy Guestbook platform — a digital welcome book system for properties such as apartments, lofts, and guesthouses.

## Project Overview

Welcomy allows property owners to create beautifully structured welcome pages for their guests, hosted under a custom subdomain.

### Example Case Studies

- https://lias-apartment.welcomy.net/
- https://vasileiosloft.welcomy.net/

## Features

- Laravel 10.x with REST API architecture
- Multi-auth system for property owners
- CRUD functionality for:
  - Properties
  - Rules
  - Amenities
  - Location Info
  - WiFi Info
  - FAQs
  - Transportation Info
  - Reviews
  - Recommendations (with categories and media)
  - Appearance Settings (colors, logo, gallery)
  - Before You Go Notes
  - Appliances (images, descriptions, YouTube links)
- Cloudinary integration for optimized image uploads (per property and user)
- Livewire-powered admin UI
- Dynamic subdomain routing for property access
- Tailored JSON API for consumption by the frontend
- Modular design using separate Eloquent models
- Factory, Seeder, and UUID support
- Validation on all endpoints
- Policy Gates for user-specific data access
- Environment: PHP 8.2, MySQL/PostgreSQL, Laravel Sail or Docker compatible

## Licensing

**LICENSE: All rights reserved.**

This repository is public only for showcase purposes. Cloning, reusing, or copying any part of this code without prior permission is strictly prohibited.

Contact: **Armenis Nick – armenisnick@gmail.com**
