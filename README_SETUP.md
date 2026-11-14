# Website Katalog Calung · Mandiri Laras Production

Proyek MPI Kelompok 3 (Laras Digital Studio). Laravel 13 + Filament 5 + Tailwind CSS 4 + SQLite.
Semua produk, harga, dan nomor WhatsApp masih **data uji**. Website ini hanya untuk demo lokal: jangan diunggah ke internet sebelum ada izin pemilik usaha (risiko R5, Pasal 6 draf kontrak).

## Menjalankan di laptop (Laravel Herd, Windows)

Buka terminal di folder `D:\Coding\Kuliah\mpi-katalog-calung`, lalu:

```bat
copy .env.example .env
```

Buka `.env`, isi `ADMIN_PASSWORD=` dengan kata sandi admin pilihan kamu (jangan dibagikan, jangan di-commit).

```bat
composer install
php artisan key:generate
type nul > database\database.sqlite
php artisan migrate --seed
php artisan storage:link
herd link mpi-katalog-calung
```

Buka http://mpi-katalog-calung.test. Panel admin ada di http://mpi-katalog-calung.test/admin dengan email `admin@larasdigital.test` dan kata sandi dari `ADMIN_PASSWORD`.

Catatan:
- `APP_URL` di `.env` harus sama dengan alamat yang dibuka di browser. Kalau beda, foto di tabel admin tidak muncul.
- Folder `public/build` sudah disertakan, jadi tampilan langsung jalan tanpa npm. Kalau mengubah CSS/JS, jalankan `npm install` lalu `npm run build`.
- Mengembalikan data uji seperti awal: `php artisan migrate:fresh --seed`.

## Isi yang sengaja tidak disertakan

`.env`, `vendor/`, `node_modules/`, `database/database.sqlite`, file unggahan di `storage/app/public`, dan log. Semua dibuat ulang lewat langkah di atas.

## Keamanan dependensi

`composer audit` per 9 November 2026 menemukan advisory pada beberapa paket bawaan kerangka kode (antara lain laravel/framework, filament/filament, league/commonmark). Untuk demo lokal risikonya kecil. Sebelum website dipublikasikan, jalankan `composer update`, lalu uji ulang 20 skenario.
