![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white)

# Sistem Inventaris - ORANG_AWAM

Proyek Sistem Informasi Manajemen Inventaris untuk mata kuliah Pemograman II.

## Cara Menjalankan Proyek
Untuk menjalankan proyek ini di laptop masing-masing, ikuti langkah-langkah berikut:

1. **Clone Repository**
   ```bash
   git clone [https://github.com/cu911030-prog/ORANG_AWAM--Proyek-inventaris-.git](https://github.com/cu911030-prog/ORANG_AWAM--Proyek-inventaris-.git)

        A. Install Dependensi
            composer install
            npm install

        B. Konfigurasi Environment
            Salin file .env.example menjadi .env:
                copy .env.example .env
            
            Generate key aplikasi:
                php artisan key:generate

        C. Setup Database
            Pastikan database MySQL Anda aktif (XAMPP).
            Jalankan migrasi tabel:
                php artisan migrate

        D. Jalankan Server
            php artisan serve

### Tips agar tidak muncul angka ganda:
*   Pastikan **tidak ada baris kosong** yang berlebihan di antara nomor-nomor tersebut.
*   Jika Anda tetap ingin menggunakan format yang sedikit berbeda, Anda bisa mengganti penomoran dengan tanda *bullet point* (`*`) agar tidak perlu pusing dengan urutan angka.

Setelah Anda ganti dengan kode di atas, silakan simpan dan lakukan `git push` kembali. Sekarang tampilannya di GitHub pasti akan terlihat jauh lebih rapi. Apakah sudah berhasil diperbaiki?