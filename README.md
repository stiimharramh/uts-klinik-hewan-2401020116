
# Sistem Pasien Klinik Hewan

Aplikasi CRUD pasien hewan berbasis Laravel 13 dan MySQL untuk memenuhi tugas UTS Praktikum Pemrograman Web.

## Identitas
- Nama: Siti Muharramah
- NIM: 2401020116
- Program Studi: Teknik Informatika
- Universitas: Universitas Maritim Raja Ali Haji

## Fitur
- Menampilkan daftar pasien hewan
- Menambahkan pasien hewan
- Mengedit data pasien hewan
- Menghapus data pasien hewan
- Pencarian berdasarkan kode pasien, nama hewan, dan nomor rekam
- Filter berdasarkan jenis hewan
- Validasi input dan pencegahan data duplikat
- Status usia hewan (Muda/Dewasa)

## Validasi Data

- Kode pasien harus terdiri dari 10 karakter alfanumerik.
- Nama hewan minimal 2 dan maksimal 100 karakter.
- Nomor rekam minimal 5 dan maksimal 30 karakter.
- Kode pasien dan nomor rekam tidak boleh duplikat.
- Usia hewan harus berupa bilangan bulat 0 sampai 30.
- Jenis hewan wajib dipilih dari data yang tersedia.

## Teknologi
- Laravel 13
- PHP 8.3
- MySQL
- Blade
- HTML

## Struktur Database
Database: `klinik_hewan_2401020116`

Tabel:
1. `jenis_hewan`
2. `pasien_hewan`

## Instalasi

1. Clone atau download repository.
2. Install dependency Laravel:

   ```bash
   composer install
   ```

3. Salin `.env.example` menjadi `.env`.

   ```bash
   cp .env.example .env
   ```

4. Generate application key:

   ```bash
   php artisan key:generate
   ```

5. Buat database MySQL bernama `klinik_hewan_2401020116`.
6. Atur konfigurasi database pada `.env`.
7. Jalankan migration dan seeder:

   ```bash
   php artisan migrate --seed
   ```

8. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

9. Buka `http://127.0.0.1:8000/pasien-hewan`

## File SQL
File export database tersedia pada:

`database/klinik_hewan_2401020116.sql`
