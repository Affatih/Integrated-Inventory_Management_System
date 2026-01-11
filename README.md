# eWARUNG MADURA
# Laporan Praktikum 13: Optimasi Penampilan Data dengan Pagination

## 1. Identitas Sistem
* **Nama Sistem:** MADURA-STOCK (Integrated Inventory Management System)
* **Versi:** 1.2.0 (Stable)
* **Fitur Utama:** CRUD, Dashboard Statistik, Autentikasi Session, & Data Pagination.

## 2. Latar Belakang & Tujuan
Seiring bertambahnya data barang di database, menampilkan seluruh data dalam satu halaman akan memperlambat performa sistem (loading time) dan merusak pengalaman pengguna (UX). Praktikum ini bertujuan untuk membagi data ke dalam beberapa halaman menggunakan teknik **Pagination**.

## Instalasi (Installation Guide)

1. **Persiapan Lingkungan:**
   - Install **XAMPP** (Rekomendasi PHP 7.4+).
   - Aktifkan **Apache** dan **MySQL** di XAMPP Control Panel.
2. **Penempatan Proyek:**
   - Ekstrak folder proyek ke `C:\xampp\htdocs\warung_madura`.
3. **Konfigurasi Database:**
   - Buka `localhost/phpmyadmin` dan buat database bernama `db_warung`.
   - Import file SQL yang terletak di `/database/db_warung.sql`.
   - Sesuaikan konfigurasi pada file `config.php`.
4. **Akses Sistem:**
   - Buka browser dan akses `http://localhost/warung_madura/`.
   - Akun Login Default: `admin` / `admin123`.

---

## Struktur Folder Modular
```text
warung_madura/
├── class/           # Library OOP (Database.php)
├── database/        # Dump file .sql database
├── module/          # Fitur Aplikasi (Dashboard, Barang)
├── config.php       # Pengaturan Koneksi Database
├── index.php        # Front Controller (Pusat Routing)
├── login.php        # Autentikasi User
└── logout.php       # Penghapusan Session
```
**.htaccess**
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

## 3. Implementasi Teknikal (LIMIT & OFFSET)
Sistem ini menggunakan query SQL dinamis dengan parameter `LIMIT` dan `OFFSET` untuk membatasi pengambilan data dari database.

**Logika Perhitungan:**
1.  **Limit:** Menentukan jumlah data per halaman (Dalam sistem ini: 5 data).
2.  **Offset:** Menentukan titik awal pengambilan data berdasarkan halaman yang dipilih.
    * *Rumus: (Halaman Aktif * Limit) - Limit*

**Cuplikan Kode SQL Dinamis:**
```php
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$offset = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$sql = "SELECT * FROM data_barang LIMIT $offset, $batas";
```

## 4. Komponen Antarmuka (UI)
Sistem navigasi halaman diletakkan pada bagian bawah tabel menggunakan komponen *Bootstrap Pagination*. Komponen ini mengirimkan parameter GET['halaman'] ke URL untuk memicu perubahan data yang ditampilkan tanpa mengganggu parameter pencarian yang sedang aktif.

## 5. Implementasi (Screenshot)
**A. Navigasi Halaman** (Pagination Bar)
<img width="1366" height="768" alt="Screenshot at 2026-01-11 04-47-24" src="https://github.com/user-attachments/assets/cd6ce6c8-086c-4d5e-90fe-e0b6946a5ff8" />
<img width="1366" height="768" alt="Screenshot at 2026-01-11 04-47-33" src="https://github.com/user-attachments/assets/1bd96ecd-90fa-4ec0-bd47-7add78d13add" />

*Fokus pada bagian bawah tabel yang menampilkan tombol angka 1, 2, 3] Keterangan: Bukti navigasi antar halaman data.*

**B. Integrasi Fitur Search & Pagination**
<img width="1366" height="768" alt="Screenshot at 2026-01-11 04-49-50" src="https://github.com/user-attachments/assets/db89ba44-f293-4e82-80bc-bf52c6ff4003" />


*hasil pencarian yang terbagi ke dalam beberapa halaman] Keterangan: Sistem tetap mempertahankan kata kunci pencarian saat berpindah halaman.*

