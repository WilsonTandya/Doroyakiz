# IF3110-2021-01-20

## Kelompok 20: haissem

-   13519058 - Dionisius Darryl Hermansyah
-   13519190 - Gregorius Dimas Baskara
-   13519209 - Wilson Tandya

## Deskripsi Aplikasi web

Aplikasi web yang dibangun merupakan sebuah sistem informasi yang digunakan untuk melakukan manajemen / pengelolaan stok dorayaki. Berikut ini merupakan spesifikasi dari aplikasi web:

1. Implementasi client-side menggunakan Javascript, HTML, dan CSS.
2. Implementasi server-side menggunakan PHP murni tanpa framework
3. Implementasi basis data menggunakan SQLite.
4. Sistem bersifat monolithic (interface dan logika pemrosesan digabung menjadi satu).

Fitur yang dimiliki aplikasi antara lain:

1. Seluruh pengguna harus melakukan autentikasi untuk dapat mengakses seluruh
   fitur lainnya. Pengguna dibedakan menjadi 2 kategori: user dan admin.
2. Admin dapat melakukan pengelolaan varian dorayaki.
3. Admin dapat melakukan manajemen stok dorayaki.
4. Admin dapat melihat riwayat perubahan stok dorayaki.
5. User dapat melihat daftar varian dorayaki
6. User dapat melakukan pembelian dorayaki
7. User dapat melihat riwayat pembelian dorayaki.

## Daftar Requirement

-   PHP 8
-   SQLite3
-   XAMPP (Untuk menjalankan server secara lokal)

## Cara Instalasi

## Aktivasi SQLite3 pada PHP

1. Buka php.ini in C:\xampp\php
2. Tambahkan / uncomment kode ini

```bash
extension=sqlite3
extension=pdo_sqlite
sqlite3.extension_dir = "C:\xampp\php\ext"
```

[Referensi tambahan](https://www.nyingspot.com/2017/10/cara-mengaktifkan-sqlite3-di-php-windows/)

## Cara Menjalankan server

## Screenshot Tampilan Aplikasi

    - Screenshot tampilan aplikasi (tidak perlu semua kasus, minimal 1 per halaman), dan

## Pembagian Tugas

#### Server-side

| Item     | NIM                |
| -------- | ------------------ |
| Login    | 13519xxx, 13519xxx |
| Register | 13519xxx           |

#### Client-side

| Item     | NIM                |
| -------- | ------------------ |
| Login    | 13519xxx, 13519xxx |
| Register | 13519xxx           |
