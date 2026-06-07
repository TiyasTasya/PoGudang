<p align="center">
<a href="{{ url('/') }}">
    <svg width="200" viewBox="0 0 680 400" role="img" xmlns="http://www.w3.org/2000/svg">
        <title>PoGudang</title>

        <!-- Roof / atap gudang -->
        <polygon points="340,90 230,155 450,155" fill="#2d6aff"/>

        <!-- Badan gudang -->
        <rect x="238" y="155" width="204" height="120" rx="0" fill="#2355cc"/>

        <!-- Pintu utama -->
        <rect x="310" y="205" width="60" height="70" rx="6" fill="#0f172a"/>
        <line x1="340" y1="205" x2="340" y2="275" stroke="#2d6aff" stroke-width="2"/>
        <circle cx="326" cy="243" r="3" fill="#5b8aff"/>
        <circle cx="354" cy="243" r="3" fill="#5b8aff"/>

        <!-- Jendela kiri -->
        <rect x="248" y="168" width="40" height="32" rx="4" fill="#0f172a"/>
        <line x1="268" y1="168" x2="268" y2="200" stroke="#2d6aff" stroke-width="1.5"/>
        <line x1="248" y1="184" x2="288" y2="184" stroke="#2d6aff" stroke-width="1.5"/>

        <!-- Jendela kanan -->
        <rect x="392" y="168" width="40" height="32" rx="4" fill="#0f172a"/>
        <line x1="412" y1="168" x2="412" y2="200" stroke="#2d6aff" stroke-width="1.5"/>
        <line x1="392" y1="184" x2="432" y2="184" stroke="#2d6aff" stroke-width="1.5"/>

        <!-- Garis bawah -->
        <rect x="238" y="271" width="204" height="4" fill="#1e40af"/>

        <!-- Ventilasi atas -->
        <rect x="325" y="78" width="30" height="16" rx="3" fill="#2355cc"/>

        <!-- Teks PoGudang -->
        <text x="340" y="318" text-anchor="middle" font-size="32" font-weight="500"
              fill="#1e293b" font-family="sans-serif" letter-spacing="1">PoGudang</text>

        <!-- Tagline -->
        <text x="340" y="342" text-anchor="middle" font-size="13"
              fill="#5b8aff" font-family="sans-serif" letter-spacing="2">SISTEM MANAJEMEN GUDANG</text>
    </svg>
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

# PoGudang

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
git clone https://github.com/TiyasTasya/PoGudang.git
cd PoGudang
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
