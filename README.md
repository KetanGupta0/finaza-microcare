# Finaza Microcare Website

Laravel 13 website for [finazamicrocare.com](https://finazamicrocare.com) (Finaza Micro Care Federation of India, CIN U65100BR2022NPL057169), with an admin panel for website enquiries.

## What's inside

| Area | Files |
|---|---|
| Public pages (Home, About, Services, Contact, Privacy, Terms) | `routes/web.php`, `app/Http/Controllers/PageController.php`, `resources/views/pages/*` |
| Shared layout, SEO meta, JSON-LD, header/footer | `resources/views/components/layouts/site.blade.php` |
| Enquiry form → `leads` table | `resources/views/components/enquiry-form.blade.php`, `app/Http/Controllers/LeadController.php`, `app/Http/Requests/StoreLeadRequest.php` |
| Admin panel (`/admin`) — leads table, filters, status/notes, CSV export | `app/Http/Controllers/Admin/*`, `resources/views/admin/*` |
| Site content: phone, address, company details, services | `config/site.php` (phone/email/hours can be set in `.env`) |
| Logo, favicon, social image | `public/images/brand/` |
| Photos (Unsplash License, free for commercial use) | `public/images/photos/` |

Styles use Tailwind CSS 4 (`resources/css/app.css`), icons come from the Lucide CDN. The compiled assets in `public/build` are committed, so the server does not need Node.js.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build   # only needed after changing CSS/JS/Blade classes
php artisan serve
```

## Create an admin login

```bash
php artisan app:create-admin-user owner@example.com --name="Owner"
```

You will be asked for a password. Run the same command again to reset a password. Then open `/admin`.

## Deploying (shared hosting / cPanel)

1. Upload the project, run `composer install --no-dev --optimize-autoloader`.
2. Point the domain's document root to the `public/` folder.
3. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://finazamicrocare.com` and database settings in `.env`.
4. `php artisan migrate --force`
5. `php artisan app:create-admin-user you@example.com`
6. `php artisan config:cache && php artisan route:cache && php artisan view:cache`
7. Submit `https://finazamicrocare.com/sitemap.xml` in Google Search Console and create a Google Business Profile for the office.

## Tests

```bash
php artisan test
```
