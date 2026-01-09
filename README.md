# Sistem Jurnal KBM

Sistem Jurnal KBM berbasis web yang digunakan oleh guru untuk mencatat kegiatan belajar mengajar harian serta melakukan export data jurnal ke file Excel (CSV).

Aplikasi ini dibuat sederhana, fokus pada kemudahan penggunaan, dan sesuai dengan kebutuhan pencatatan jurnal KBM.

---

## Fitur Utama
- Login guru
- Register guru
- Input jurnal KBM
- Edit dan hapus jurnal
- Menampilkan daftar jurnal
- Export jurnal ke Excel (CSV)
  - Export jurnal pribadi
  - Export semua jurnal
- Logout


---

## Role Pengguna
### Guru
- Login ke sistem
- Mengelola data jurnal KBM milik sendiri
- Melakukan export jurnal pribadi
- Melakukan export semua jurnal

> Catatan:  
> Sistem ini tidak memiliki role admin maupun fitur pengelolaan data master (guru, siswa, kelas, mapel) sesuai dengan kesepakatan awal pengembangan.

---

## Teknologi yang Digunakan
- Laravel 12
- PHP 8.4
- SQLite
- Tailwind CSS