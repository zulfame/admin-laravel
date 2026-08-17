# Admin Panel (Laravel + SQLite)

## Original problem statement
"buatkan sebuah admin panel menggunakan dengan teknologi laravel dan sqlite, buat tempilan ui yang bagus hanya menggunakan tailwind dengan aturan wajib compact ui, untuk font full gunakan geist, buatkan saja 1 halaman dashboard halaman kosong atau placeholder, untuk tailwind gunakan cdn" (+ "tailwind juga gunakan cdn")

## User choices (2026-06)
- No auth, straight to dashboard
- Light + dark theme with toggle
- Sidebar: Dashboard only
- Dashboard content: completely empty placeholder
- Icons: inline Heroicons SVG

## Architecture
- Laravel 12.66 (PHP 8.2), SQLite at /app/adminpanel/database/database.sqlite
- Blade views, Tailwind via CDN (inline `tailwind.config`), Geist + Geist Mono from Google Fonts
- Vanilla JS only (theme toggle, sidebar collapse, user dropdown, Cmd+K) — no Alpine/React/Vue
- Served on port 3000 via `php artisan serve`; supervisor `frontend` program's start script in /app/frontend/package.json points to Laravel (`start:react` kept as the old CRA script)

## Files
- routes/web.php — `/` -> redirect `/dashboard`; `/dashboard` -> view
- resources/views/layouts/app.blade.php — shell (sidebar, topbar, footer, theme system)
- resources/views/dashboard.blade.php — empty-state placeholder

## Implemented (2026-06)
- Compact UI shell: 48px topbar, 28px controls, 11.5px body type, dense sidebar
- Collapsible sidebar (208px <-> 56px) with localStorage persistence
- Light/dark theme via CSS variables + `dark` class, persisted, no FOUC
- Search with Cmd/Ctrl+K, notification bell, user dropdown
- Status footer (sqlite connected / laravel / php version)
- Tested: 27/27 frontend assertions passed (iteration_1.json)

## Backlog
- P1: Real CRUD modules (Users, Products, Orders) + Eloquent models/migrations
- P1: Auth (login) if needed later
- P2: Command palette for Cmd+K, breadcrumb driven by route
- P2: Replace Tailwind CDN with a compiled build before production

## Update: Autentikasi Admin (2026-06)
- Autentikasi murni tanpa paket scaffolding (tanpa Breeze/Fortify/Jetstream), memakai guard `web` + middleware `auth`/`guest` bawaan Laravel
- `app/Http/Controllers/AuthController.php` — `Auth::guard('web')->attempt()`, `session()->regenerate()`, rate limit 5 percobaan gagal / 15 menit per IP+email, logout invalidate + regenerateToken
- `bootstrap/app.php` — trustProxies('*'), redirectGuestsTo('/login'), redirectUsersTo('/dashboard')
- `database/seeders/AdminSeeder.php` — seeder idempotent dari ADMIN_EMAIL/ADMIN_PASSWORD/ADMIN_NAME di .env
- `resources/views/auth/login.blade.php` — halaman masuk compact (toggle tema, show/hide password, remember me, CSRF)
- Layout menampilkan identitas admin asli + form logout di dropdown user
- Kredensial: lihat /app/memory/test_credentials.md (admin@nexus.local / Admin12345)
- Tested: 30/30 assertion lolos (test_reports/iteration_2.json), tidak ada bug

## Backlog (diperbarui)
- P1: Modul CRUD (Users, Products, Orders)
- P2: Lupa kata sandi / ubah kata sandi dari panel
- P2: Command palette Cmd+K, breadcrumb dinamis
- P2: Ganti Tailwind CDN dengan build terkompilasi sebelum produksi
