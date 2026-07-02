# Sistem Inventaris — Setup (Tamam task)

Task: `chore: breeze install & initial config`

Tujuan: menyiapkan proyek Laravel dasar dan menyediakan langkah yang diperlukan untuk menginstal Laravel Breeze, generate app key, dan menjalankan migration users table.

Langkah yang harus dijalankan secara lokal (di mesin Anda):

```bash
# buat project baru (jika belum):
composer create-project laravel/laravel sistem-inventaris
cd sistem-inventaris

# pasang Laravel Breeze (Blade):
composer require laravel/breeze --dev
php artisan breeze:install blade

# install frontend deps dan build (opsional untuk Blade + assets):
npm install
npm run build

# konfigurasi env (sesuaikan DB pada .env atau gunakan .env.example):
cp .env.example .env
php artisan key:generate

# jalankan migration (users table sudah termasuk di migration default):
php artisan migrate
```
 
Catatan: langkah-langkah di atas harus dijalankan di lingkungan pengembangan lokal Anda. File-file skeleton berikut juga dibuat sebagai referensi untuk task ini.
