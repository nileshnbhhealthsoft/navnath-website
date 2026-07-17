# Ascent Corporate Website — Laravel 12 + Admin Panel

A complete responsive corporate website for **Ascent**, designed around the supplied purple/pink logo and inspired by the clean consulting, impact, service, and case-study presentation of the two client references.

## Stack

- Laravel 12
- PHP 8.2+
- Blade templates
- SQLite by default; MySQL supported
- Static CSS and JavaScript in `public/assets`
- No Node.js, npm, Vite, or frontend build step

## Included

### Public website

- Elegant responsive home page matching the Ascent logo palette
- Sticky navigation and mobile menu
- Hero, metrics, about, capabilities, industries, delivery approach, work/case studies, perspective, testimonials, CTA, contact form, and footer
- Smooth reveal animations with reduced-motion support
- SEO title, meta description, favicon, email and phone links
- Real database-backed contact form with validation, honeypot protection, and rate limiting

### Admin panel

Open `/admin` after setup. The panel includes:

- Dashboard overview
- Fully editable website text and links
- Editable logo, favicon, hero, about, services, industries, case studies, testimonials, and contact media
- Editable brand theme colours
- Contact enquiry listing
- Secure session login using credentials from `.env`

The supplied Ascent logo is included in transparent PNG form and already configured as the default header/footer logo and favicon.

## Quick start

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Windows CMD:

```bat
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open:

- Website: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin`

Default development admin credentials from `.env.example`:

```text
Email: admin@ascent.in
Password: ChangeMe123!
```

**Change both values before deployment.**

## MySQL setup

Create a database, then update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ascent_website
DB_USERNAME=root
DB_PASSWORD=
```

Run:

```bash
php artisan migrate --seed
```

## Content and images

Text content is stored in the `site_contents` table as JSON. Uploaded files are saved in:

```text
public/uploads/site-media
```

No storage symlink is required.

The admin text editor covers all configured sections. The media manager covers 24 image slots, including brand files, hero/about imagery, six service images, six industry images, three case studies, two testimonial avatars, and contact imagery.

## Contact enquiries

Public form submissions are stored in the `contact_submissions` table and are visible under **Admin → Contact Messages**.

## Deployment notes

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Set these production values in `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
ADMIN_EMAIL=your-secure-admin-email
ADMIN_PASSWORD=your-long-unique-password
```

Point the web server document root to the Laravel `public` directory and ensure PHP can write to `storage`, `bootstrap/cache`, and `public/uploads/site-media`.

## Validation completed

- PHP syntax validation across application, config, migrations, routes, and tests
- Responsive CSS and JavaScript reviewed
- Logo PNGs generated from the client-supplied artwork
- Laravel feature tests updated for Ascent content and form options

Run the automated test suite after installing dependencies:

```bash
php artisan test
```
