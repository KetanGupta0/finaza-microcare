# Finaza Microcare — Coming Soon

Laravel 13 app serving the Diwali "Coming Soon" page for [finazamicrocare.com](https://finazamicrocare.com).

## What's inside

| File | Purpose |
|---|---|
| `routes/web.php` | `/` → `ComingSoonController` |
| `app/Http/Controllers/ComingSoonController.php` | Prepares launch date, phone and map link for the view |
| `config/site.php` | Site name, launch date, phone, address (overridable via `.env`) |
| `resources/views/coming-soon.blade.php` | Page markup |
| `public/css/coming-soon.css`, `public/js/coming-soon.js` | Styles, countdown, fireworks animation (no build step needed) |

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate        # creates the default SQLite tables
php artisan serve
```

Open http://127.0.0.1:8000.

## Configuration (`.env`)

```dotenv
SITE_NAME="Finaza Microcare"
SITE_LAUNCH_AT=2026-11-08T00:00:00+05:30   # countdown target (Diwali 2026)
SITE_TIMEZONE=Asia/Kolkata
SITE_PHONE=8009877918
SITE_COUNTRY_CODE=+91
```

When the countdown reaches zero the page switches to a "We're Live!" message automatically.

## Deploying (shared hosting / cPanel)

1. Upload the project, run `composer install --no-dev --optimize-autoloader`.
2. Point the domain's document root to the `public/` folder.
3. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://finazamicrocare.com` in `.env`.
4. `php artisan config:cache && php artisan route:cache && php artisan view:cache`

## Tests

```bash
php artisan test
```
