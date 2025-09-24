# Proyek API Manajemen Buku (Adhivasindo Take Home Test)

Ini adalah proyek API backend yang dibuat dengan **Laravel 12** sebagai bagian dari *take home test*. Aplikasi ini menyediakan fungsionalitas untuk manajemen data buku dan sistem peminjaman oleh user.


## Fitur Utama

-   **Autentikasi User:** Sistem registrasi, login, dan logout berbasis token menggunakan Laravel Sanctum.
-   **Manajemen Buku (CRUD):** Fungsionalitas lengkap untuk membuat, melihat, memperbarui, dan menghapus data buku.
-   **Sistem Peminjaman:** User yang sudah login dapat meminjam buku, dan stok buku akan berkurang secara otomatis.
-   **Notifikasi Latar Belakang:** Menggunakan sistem Antrian (Queue) Laravel untuk mengirim notifikasi (via log) saat user berhasil meminjam buku.
-   **Validasi Request:** Validasi data yang masuk menggunakan Form Request terpisah.
-   **Pengujian Otomatis:** Dilengkapi dengan *Feature Test* (PHPUnit) untuk memastikan fungsionalitas inti berjalan dengan benar.

## Teknologi yang Digunakan

-   **Framework:** Laravel 12
-   **Bahasa:** PHP 8.2+
-   **Database:** MySQL
-   **Autentikasi:** Laravel Sanctum
-   **Testing:** PHPUnit

---

## Instalasi & Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1. Clone Repositori
Pertama, clone repositori ini ke mesin lokal Anda.
```bash
git clone https://github.com/ReszaDN/ApiManagementPinjamBuku.git
```

### 2. Install Dependencies
Install semua dependency PHP yang dibutuhkan menggunakan Composer.
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi file `.env`. File ini adalah tempat Anda menyimpan semua konfigurasi sensitif.
```bash
cp .env.example .env
```
Setelah itu, buat kunci aplikasi yang unik.
```bash
php artisan key:generate
```

### 4. Konfigurasi Database
Buka file `.env` dan sesuaikan pengaturan koneksi database Anda.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adhivasindo
DB_USERNAME=root
DB_PASSWORD=
```
Pastikan Anda sudah membuat database `adhivasindo` di MySQL Anda.

### 5. Jalankan Migrasi dan Seeder
Perintah ini akan membuat semua struktur tabel database dan mengisinya dengan data awal (10 user dan 30 buku).
```bash
php artisan migrate:fresh --seed
```
> **Info:** Password untuk semua user yang dibuat oleh seeder adalah **`password`**.

---

## Menjalankan Proyek

### Menjalankan Server API
Untuk menjalankan server pengembangan Laravel, gunakan perintah `serve`.
```bash
php artisan serve
```
Secara default, API akan dapat diakses di `http://127.0.0.1:8000`.

### Menjalankan Queue Worker
Aplikasi ini menggunakan antrian untuk notifikasi. Untuk memproses job di dalam antrian, jalankan perintah berikut di terminal terpisah.
```bash
php artisan queue:work
```

---

## Menjalankan Tes
Untuk menjalankan semua pengujian otomatis, gunakan perintah `test`.
```bash
php artisan test
```

---

## Struktur Endpoint API

Berikut adalah daftar semua endpoint yang tersedia.

| Method | Endpoint             | Deskripsi                                  | Butuh Autentikasi? |
| :----- | :------------------- | :----------------------------------------- | :----------------- |
| `POST` | `/api/register`      | Mendaftarkan user baru.                    | Tidak              |
| `POST` | `/api/login`         | Login untuk mendapatkan Bearer Token.      | Tidak              |
| `GET`  | `/api/buku`          | Melihat semua data buku (paginasi).        | Publik             |
| `GET`  | `/api/buku/{buku}`   | Melihat detail satu buku.                  | Publik             |
| `POST` | `/api/buku`          | Menambah data buku baru.                   | **Ya** |
| `PUT`  | `/api/buku/{buku}`   | Memperbarui data buku.                     | **Ya** |
| `DELETE`| `/api/buku/{buku}`  | Menghapus data buku.                       | **Ya** |
| `POST` | `/api/loans`         | Meminjam sebuah buku.                      | **Ya** |
| `GET`  | `/api/loans/{user}`  | Melihat daftar buku yang dipinjam user.    | **Ya** |
| `GET`  | `/api/user`          | Melihat detail user yang sedang login.     | **Ya** |
| `POST` | `/api/logout`        | Logout dan menghapus token.                | **Ya** |


---
## Dokumen Collection POSTMAN

https://documenter.getpostman.com/view/25858824/2sB3QCSYwd
