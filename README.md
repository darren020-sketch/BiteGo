# 🌱 iSosial — Sistem Manajemen Relawan Sekolah

iSosial adalah aplikasi berbasis web yang dikembangkan untuk membantu sekolah dalam mengelola kegiatan sosial dan relawan secara terstruktur, efisien, dan transparan.

Proyek ini dibuat oleh **Kelompok 9** dari **SMK Kristen Immanuel Pontianak**.

---

## 📖 Latar Belakang

Sekolah secara rutin menyelenggarakan berbagai kegiatan sosial seperti bakti sosial, kerja bakti, penggalangan dana, dan program kemanusiaan. Namun, proses pendataan relawan masih dilakukan secara manual sehingga sering terjadi:

- Kesalahan pencatatan dan kehilangan data
- Kesulitan dalam pengelolaan informasi kegiatan
- Penyampaian informasi yang tidak merata kepada siswa
- Tidak adanya sistem penyimpanan riwayat keterlibatan siswa

Kondisi ini menyulitkan pihak sekolah dalam melakukan **monitoring**, **evaluasi**, dan **pelaporan partisipasi siswa**, serta menurunkan transparansi informasi bagi siswa dan orang tua.

---

## 🎯 Tujuan Aplikasi

Aplikasi **iSosial** dikembangkan untuk:

1. Mendukung operasional kegiatan sosial
2. Memberikan edukasi dan pembinaan
3. Memfasilitasi penggalangan dana dan sumber daya
4. Memberikan dukungan emosional dan sosial
5. Membangun relasi dan jejaring sosial

---

## 👥 Target Pengguna

| Peran | Deskripsi |
|-------|-----------|
| **Manajemen Sekolah** | Menggunakan data dan laporan untuk evaluasi serta perencanaan kegiatan sosial. |
| **Guru Pembina / Koordinator** | Mengatur pelaksanaan kegiatan, menentukan kebutuhan relawan, dan memantau kontribusi siswa. |
| **Administrator / Staf Kesiswaan** | Mengelola data kegiatan, memverifikasi pendaftaran relawan, dan menyusun laporan partisipasi. |
| **Siswa (Relawan)** | Mengakses informasi kegiatan, mendaftar secara daring, dan melihat riwayat keterlibatan sosial. |

---

## 💡 Solusi yang Ditawarkan

Sebagai solusi atas permasalahan pengelolaan kegiatan sosial di sekolah, **iSosial** hadir dengan fitur-fitur utama berikut:

- Pencarian aktivitas sosial
- Informasi detail kegiatan (tanggal, lokasi, kuota relawan)
- Pendaftaran relawan secara daring
- Manajemen kegiatan oleh admin
- Riwayat keterlibatan dan kegiatan selesai
- Statistik dan pelaporan partisipasi di dashboard

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|-----------|
| **Frontend** | HTML, CSS, JavaScript |
| **Backend** | PHP (MVC custom, PSR-4 autoload) |
| **Database** | MySQL |
| **Server** | Apache/Nginx + PHP (XAMPP / local server) |

---

## 🧩 Struktur Halaman

| No | Halaman | Route / Akses |
|----|---------|----------------|
| 1 | Home Page — daftar kegiatan sosial | `/` |
| 2 | Tentang — visi, misi, dan fitur aplikasi | `/about` |
| 3 | Login & Register | `/login`, `/register` |
| 4 | Dashboard — statistik kegiatan dan relawan | `/dashboard` |
| 5 | Manajemen Kegiatan | `/dashboard/kegiatan` |
| 6 | Pendaftaran Relawan (detail kegiatan) | `/daftar-relawan?id={id}` |
| 7 | Riwayat Kegiatan | `/dashboard/riwayat` |
| 8 | Manajemen Relawan / Pengguna | `/dashboard/relawan`, `/dashboard/admin/users` |

---

## Struktur Proyek

```
isosial-main/
├── database/
│   ├── isosial_db.sql          # Dump database (kegiatan, users, relawan)
├── public/
│   ├── index.php               # Entry point aplikasi
│   ├── css/
│   └── assets/
├── src/
│   ├── Config/                 # Koneksi database
│   ├── Controllers/
│   ├── Models/
│   ├── Routes/
│   └── Views/
└── vendor/                     # Composer autoload
```

---

## Instalasi & Menjalankan

### Prasyarat

- PHP 8.x
- MySQL / MariaDB
- Composer
- Web server (XAMPP direkomendasikan)

### Langkah

1. **Clone atau salin** proyek ke folder web server (mis. `htdocs/isosial-main`).

2. **Install dependensi Composer:**
   ```bash
   composer install
   ```

3. **Buat database** `isosial_db` di phpMyAdmin.

4. **Import database:**
   - Import file `database/isosial_db.sql`
   - Opsional: jalankan `database/seed_relawan_kegiatan.sql` untuk data contoh relawan per kegiatan

5. **Sesuaikan koneksi database** di `src/Config/Database.php` jika perlu:
   ```php
   $host = 'localhost';
   $username = 'root';
   $password = '';
   $database = 'isosial_db';
   ```

6. **Arahkan document root** ke folder `public/`, atau akses:
   ```
   http://localhost/isosial-main/public/
   ```

7. **Login admin** (sesuai data di `isosial_users` setelah import SQL).

---

## Database

| Tabel | Fungsi |
|-------|--------|
| `isosial_kegiatan` | Data kegiatan sosial (nama, lokasi, tanggal, gambar, kuota relawan) |
| `isosial_users` | Akun admin dan relawan (siswa) |
| `isosial_relawan_kegiatan` | Relasi pendaftaran relawan per kegiatan |

---

## 👨‍💻 Tim Pengembang

**Kelompok 9 — SMK Kristen Immanuel Pontianak**

- Bryan Geraldo Lim
- Oliver Marvel Jonathan
- Luis Fabian Lorenso

---

## 📍 Informasi Sekolah

**SMK Kristen Immanuel**  
Jl. Letnan Jendral Sutoyo, Parit Tokaya, Kec. Pontianak Sel., Kota Pontianak, Kalimantan Barat 78121  

📞 +62 898 8890 298

---

## 🌟 Motto

> *Ubah niat baik jadi aksi baik hari ini.*
