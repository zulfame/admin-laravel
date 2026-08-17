# Nexus Admin Panel (Laravel 12 + SQLite)

## Original problem statement
"buatkan sebuah admin panel menggunakan teknologi laravel dan sqlite, buat tampilan ui yang bagus hanya menggunakan tailwind dengan aturan wajib compact ui, untuk font full gunakan geist, buatkan saja 1 halaman dashboard halaman kosong atau placeholder, untuk tailwind gunakan cdn"

## Permintaan lanjutan (kronologis)
1. Login admin — autentikasi murni tanpa paket, boleh pakai middleware `auth` bawaan dengan guard `web`
2. Brand lockup lebih presisi (sidebar + login)
3. Halaman **Interface** (katalog komponen, tanpa Authentication/Error pages, wajib ada Modals) & **Elements** (form elements ala Tabler)
4. Searchable select (select2) tanpa paket
5. Footer modal & form: 2 tombol → pojok kiri & pojok kanan
6. Menu **Datatable** dengan 3 contoh tabel
7. Modal: ukuran sm/md/lg + posisi center/top; modal konfirmasi disamakan dengan modal biasa
8. Skala tipografi dinaikkan & bilangan bulat (18/16/14/13/10), diterapkan di semua halaman
9. Semua CSS/JS dipindah ke struktur asset admin template
10. UI rapi di semua ukuran device
11. Halaman **Profil**: informasi diri + upload foto + ubah kata sandi (tanpa "Zona waktu"), header/footer card sama tinggi & rapat

## Arsitektur
- Laravel 12.66 (PHP 8.2), SQLite `database/database.sqlite`
- Blade + Tailwind CDN (config inline via `assets/js/tailwind.config.js`), font Geist + Geist Mono
- Vanilla JS saja (tanpa Alpine/jQuery/React)
- Disajikan di port 3000 via `php artisan serve`; supervisor program `frontend` (script `start` di /app/frontend/package.json)

## Struktur asset
```
public/assets/css/app.css     tokens tema, skala tipografi, utilitas layout, komponen form, animasi
public/assets/js/theme.js     bootstrap tema (anti FOUC) + apToggleTheme
public/assets/js/tailwind.config.js
public/assets/js/app.js       shell: sidebar, drawer mobile, user menu, dropdown, modal, toast, Cmd+K
public/assets/js/interface.js tabs, accordion, rating, modal demo (sm/md/lg, center/top)
public/assets/js/elements.js  form helpers + searchable select (single & multi)
public/assets/js/datatable.js modul apDt (search, sort, perPage, pagination, kolom, select-all)
public/assets/js/profile.js   pratinjau avatar, eye toggle, meter kekuatan sandi
```

## Halaman
- `/login` — autentikasi murni (Auth::guard('web')->attempt, session regenerate, rate limit 5/15 menit)
- `/dashboard` — placeholder empty state
- `/interface` — 20 panel komponen
- `/elements` — 21 panel form termasuk searchable select
- `/datatable` — 3 contoh datatable
- `/profile` — informasi diri + upload foto + ubah kata sandi

## Implemented (2026-06)
- Shell compact: topbar 48px, kontrol 28px, sidebar collapsible 208↔56px, drawer di mobile
- Tema light/dark via CSS variables, persist di localStorage, tanpa FOUC
- Auth: guard web, bcrypt, throttle, seeder admin idempotent
- Profil: kolom `avatar_path/title/phone/bio` (migrasi), upload ke disk `public` + `storage:link`, ubah sandi (min 10, mixedCase, angka) dengan sesi tetap aktif
- Komponen `x-panel` dengan slot footer (header & footer 36px, rapat ke tepi kartu)
- Testing: iterasi 1-6 semua hijau (`/app/test_reports/iteration_*.json`)

## Backlog
- P1: Modul CRUD nyata (Users, Products, Orders) memakai Datatable sebagai basis
- P1: Multi-user + peran/izin (saat ini hanya satu admin)
- P2: Riwayat login (IP, waktu, status) & notifikasi nyata
- P2: Command palette untuk Cmd+K
- P2: Ganti Tailwind CDN dengan build terkompilasi sebelum produksi
