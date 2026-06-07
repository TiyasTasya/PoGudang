<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>

  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>

  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>

  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# Sistem Dokumentasi Barang (SIDOKBAR)

Project ini dibangun menggunakan framework **Laravel** dan panel admin **Filament**.

---

## 🚀 Prasyarat (Prerequisites)

Sebelum menjalankan project ini, pastikan laptop/PC kamu sudah terinstall:

- PHP 8.3
- Composer
- Git
- MySQL / SQLite
- VS Code (Opsional)

---

# ⚙️ Langkah-Langkah Instalasi

Ikuti langkah berikut untuk menjalankan project di lokal.

---

## 1. Clone Repository

Jika belum mendownload project ini, lakukan clone repository terlebih dahulu:

```bash
git clone https://github.com/TiyasTasya/sidokbar.git
cd sidokbar
```

---

## 2. Buka Project di VS Code

```bash
code .
```

---

## 3. Install Dependency Composer

Install seluruh dependency Laravel dan Filament:

```bash
composer install
```

---

## 4. Setup File Environment (.env)

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Jika menggunakan Windows CMD:

```lebih simpel
copy .env.example menjadi .env
```

---

## 5. Konfigurasi Database

Buka file `.env`, lalu sesuaikan konfigurasi database.

### Menggunakan SQLite

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

### Menggunakan MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=data_gudang
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Generate Application Key

Buat application key Laravel:

```bash
php artisan key:generate
```

---

## 7. Jalankan Migrasi Database

Kirim seluruh struktur tabel ke database:

```bash
php artisan migrate
```

---

## 8. Generate Role & Permission (Filament Shield)

Generate policy dan role otomatis menggunakan Filament Shield:

```bash
php artisan shield:generate --all
```

---

## 9. Membuat User Filament

Buat akun admin Filament:

```bash
php artisan make:filament-user
```

---

## 10. Jadikan User Sebagai Super Admin

Berikan akses Super Admin pada user pertama:

```bash
php artisan shield:super-admin --user=1
```

---

## 11. Jalankan Server Laravel

Nyalakan server development Laravel:

```bash
php artisan serve
```

---

# 🔑 Login Filament

Akses panel admin Filament melalui URL berikut:

```txt
http://127.0.0.1:8000/admin
```

Gunakan email dan password yang dibuat pada langkah sebelumnya.

---

# 🛠️ Teknologi yang Digunakan

- Laravel
- Filament
- Filament Shield
- PHP
- MySQL / SQLite

---

# 📌 Catatan

- Pastikan database sudah dibuat sebelum menjalankan migrasi.
- Jika terjadi error dependency, jalankan:

```bash
composer update
```

- Jika asset tidak muncul, jalankan:

```bash
php artisan storage:link
```

---

# 📄 License

Project ini menggunakan lisensi MIT.
