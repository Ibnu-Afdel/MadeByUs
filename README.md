# MadeByUs

A simple Laravel 12 + Livewire 3 app to showcase user projects with tags, images, and social login. Users can manage their projects, and optionally upgrade to a Premium role via Chapa payments.

## Features
- **Project showcase**: Public listing with search and tag filters (`/`, `/showcase`).
- **Project management**: Create, edit, delete projects (images via Media Library) at `/dashboard/projects`.
- **Tags**: Powered by Spatie Tags.
- **Images**: Powered by Spatie Media Library.
- **Premium upgrade**: Chapa payment flow to assign the `Premium` role.
- **Social login**: Via Laravel Socialite (e.g., Google, GitHub).
- **Settings**: Profile, password, and appearance pages.

## Tech Stack
- Laravel 12, PHP 8.2+
- Livewire 3, Volt, Flux
- Vite + Tailwind CSS
- Spatie: Permission, Media Library, Tags
- Socialite (OAuth)
- Filament (admin resources installed)

## Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+ and npm
- Database (SQLite works out of the box; MySQL/Postgres also fine)

## Setup
1. Install dependencies:
   ```bash
   composer install
   npm install
   ```
2. Create environment file and app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configure database in `.env` (SQLite by default is fine). For SQLite:
   ```bash
   touch database/database.sqlite
   # In .env set DB_CONNECTION=sqlite and comment out other DB_* vars
   ```
4. Run migrations and seed base roles/permissions:
   ```bash
   php artisan migrate --seed --class=RoleAndPermissionSeeder
   ```
5. Create storage symlink (for media uploads):
   ```bash
   php artisan storage:link
   ```

## Environment variables
Set these in `.env` as needed:
- Social login (Google example):
  - `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI`
  - For other providers, add them in `config/services.php` and set similar env vars.
- Chapa payments:
  - `CHAPA_SECRET_KEY`, `CHAPA_PUBLIC_KEY` (if using), `CHAPA_BASE_URL`, `CHAPA_CALLBACK_URL`
  - `PREMIUM_PRICE` (amount for premium upgrade)

See `config/services.php` and `config/chapa.php` for exact keys.

## Run locally
- Start PHP server and Vite in separate terminals:
  ```bash
  php artisan serve
  npm run dev
  ```
- Or use the combined dev script defined in Composer (runs server, queue worker, logs, and Vite):
  ```bash
  composer run dev
  ```

App URLs:
- Home/Showcase: `http://localhost:8000/`
- Dashboard: `http://localhost:8000/dashboard`
- Projects: `http://localhost:8000/dashboard/projects`
- Premium: `http://localhost:8000/premium/upgrade`

## Usage notes
- After logging in, manage projects at `/dashboard/projects` (upload image, set tags, etc.).
- Upgrading to Premium marks your created projects as priority.
- Media uploads require the storage symlink.

## Tests
```bash
php artisan test
```

## Build assets for production
```bash
npm run build
```

## License
MIT
