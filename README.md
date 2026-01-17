<p align="center">
  <img src="/public/img/Logo.png" width="300" alt="Laravel Logo">
</p>

<h1 align="center">SiDesa - Sistem Informasi Desa</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

**SiDesa** adalah aplikasi berbasis web yang dibangun menggunakan framework Laravel untuk mempermudah administrasi desa, pelayanan publik, dan transparansi informasi kepada masyarakat. Aplikasi ini mencakup manajemen kependudukan, layanan surat menyurat, pengaduan masyarakat, serta transparansi dana desa.

## 📋 Fitur Utama

Aplikasi ini memiliki beberapa modul utama:

- **Manajemen Kependudukan:** Pengelolaan data penduduk desa secara terpusat (`ResidentController`).
- **Layanan Surat Menyurat:** Fasilitas bagi warga untuk mengajukan permohonan surat secara online dan admin untuk memprosesnya (`LetterRequestController`, `LetterType`).
- **Pengaduan Masyarakat:** Wadah bagi masyarakat untuk menyampaikan keluhan atau aspirasi (`ComplaintController`).
- **Transparansi Dana Desa:** Pencatatan dan pelaporan kategori serta transaksi dana desa (`VillageFundController`).
- **Berita & Informasi:** Publikasi berita atau pengumuman seputar desa (`NewsController`).
- **Pencarian Global:** Fitur pencarian untuk memudahkan navigasi data (`GlobalSearchController`).
- **Dashboard Interaktif:** Tersedia dashboard khusus untuk berbagai role (Admin, Kepala Desa, Penduduk, RT/RW).
- **Manajemen Akun & Role:** Sistem autentikasi dan otorisasi bertingkat (`AuthController`, `RoleMiddleware`).

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 10/11 (PHP Framework)
- **Frontend:** Blade Templating Engine
- **UI Framework:** Bootstrap (SB Admin 2 Template)
- **Database:** MySQL
- **Build Tool:** Vite
- **PDF Generator:** DomPDF (Untuk cetak surat)

## ⚙️ Persyaratan Sistem

Sebelum melakukan instalasi, pastikan sistem Anda memiliki:

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda:

1.  **Clone Repositori**

    ```bash
    git clone [https://github.com/novandrawichdafarun/sidesa.git](https://github.com/novandrawichdafarun/sidesa.git)
    cd sidesa
    ```

2.  **Install Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Install Dependensi Frontend**

    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan sesuaikan konfigurasi database Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_sidesa
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6.  **Migrasi dan Seeding Database**
    Jalankan perintah ini untuk membuat tabel dan mengisi data dummy (Data awal admin, role, dll):

    ```bash
    php artisan migrate --seed
    ```

    _Catatan: Pastikan database sudah dibuat di phpMyAdmin atau MySQL Workbench sebelum menjalankan perintah ini._

7.  **Jalankan Build Assets**

    ```bash
    npm run build
    ```

8.  **Jalankan Server Lokal**
    ```bash
    php artisan serve
    ```

Akses aplikasi melalui browser di: `http://localhost:8000`

## 🔐 Akun Demo (Seeding)

Jika Anda telah menjalankan `php artisan migrate --seed`, silakan cek file `database/seeders/UserSeeder.php` untuk melihat akun default yang dibuat. Biasanya format defaultnya adalah:

- **Admin:**
    - Email: `admin@example.com` (atau cek seeder)
    - Password: `password`

## 📂 Struktur Proyek

Berikut adalah gambaran singkat struktur folder penting:

- `app/Http/Controllers`: Logika utama aplikasi (Auth, Dashboard, Resident, dll).
- `app/Models`: Model Eloquent untuk interaksi database.
- `database/migrations`: Struktur skema database.
- `database/seeders`: Data awal untuk pengujian.
- `resources/views`: Tampilan antarmuka (Blade templates).
- `public/template`: Aset statis dari template SB Admin 2.

## 📄 Dokumen Pendukung

Dokumentasi teknis dan panduan penggunaan dapat ditemukan di dalam folder proyek:

- `ManualBook.pdf` - Panduan penggunaan aplikasi.
- `Makalah Project SiDesa.pdf` - Latar belakang dan penjelasan proyek.

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat _Pull Request_ atau laporkan _Issue_ jika menemukan bug.

1.  Fork repositori ini.
2.  Buat branch fitur baru (`git checkout -b fitur-keren`).
3.  Commit perubahan Anda (`git commit -m 'Menambahkan fitur keren'`).
4.  Push ke branch (`git push origin fitur-keren`).
5.  Buat Pull Request.

## 📝 Lisensi

Proyek ini bersifat _open-source_. Silakan gunakan untuk tujuan pembelajaran atau pengembangan lebih lanjut.

---

**Dikembangkan oleh:** [Novandra Wichda Farun]
