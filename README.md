# Sistem Jurnal KBM

Sistem Jurnal KBM berbasis web yang digunakan oleh guru untuk mencatat kegiatan belajar mengajar harian serta melakukan export data jurnal ke file Excel (CSV).

Aplikasi ini dibuat sederhana, fokus pada kemudahan penggunaan, dan sesuai dengan kebutuhan pencatatan jurnal KBM.

---

## Fitur Utama
- Login guru
- Input jurnal KBM
- Edit dan hapus jurnal
- Menampilkan daftar jurnal
- Export jurnal ke Excel (CSV)
  - Export jurnal pribadi

---

## Role Pengguna
### Guru
- Login ke sistem
- Mengelola data jurnal KBM milik sendiri
- Melakukan export jurnal pribadi

> Catatan:  
> Sistem ini tidak memiliki role admin maupun fitur pengelolaan data master (guru, siswa, kelas, mapel) sesuai dengan kesepakatan awal pengembangan.

---

## Teknologi yang Digunakan
- Laravel 12
- PHP 8.4
- SQLite
- Tailwind CSS

---

## Cara Menjalankan Aplikasi
1. Clone repository
2. Install dependency:
   composer install
3. Copy env:
   cp .env.example .env
4. Generate key:
   php artisan key:generate
5. Jalankan:
   php artisan serve
