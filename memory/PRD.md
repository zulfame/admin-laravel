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
