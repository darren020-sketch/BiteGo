# 📋 Rangkuman Pembuatan BiteGo

> **BiteGo — Smart Canteen Platform (Pre-Order Makanan Kantin Sekolah)**

Dokumen ini merangkum seluruh pekerjaan backend & frontend yang telah diselesaikan pada proyek **BiteGo**, mulai dari database, fitur, hingga status pengujian.

---

## 1. Ruang Lingkup Pekerjaan

Proyek awal hanya berupa skeleton Laravel dengan data statis/hardcoded:
- Data menu ditulis manual di dalam controller (tanpa database).
- Tombol "Pesan" belum berfungsi.
- Halaman Pesanan & Dashboard belum ada.
- Belum ada autentikasi.

Seluruh sistem dibangun ulang menjadi aplikasi **pre-order kantin yang fully functional** sesuai visi README: *Bebas Antre, Express Pickup, Kode Unik 4 Digit, Dashboard Penjual Real-Time*.

---

## 2. Database (MySQL — database `bitego`)

Database `bitego` dibuat otomatis (jika belum ada) dengan **9 tabel**:

| Tabel | Fungsi Utama |
|---|---|
| `users` | Akun pengguna + kolom `role` (siswa/vendor), `nis`, `kelas` |
| `stalls` | Stand kantin (pemilik, nama, lokasi, gambar, status aktif) |
| `categories` | Kategori menu: Makanan Utama, Snack, Minuman, Dessert |
| `menus` | Daftar menu (stok, harga, gambar, populer/tersedia, slug) |
| `orders` | Pesanan (nomor unik, kode pickup 4 digit, slot Istirahat I/II, status) |
| `order_items` | Detail item per pesanan (snapshot nama, harga, qty, subtotal) |
| `sessions` / `cache` / `jobs` | Infrastruktur bawaan Laravel |

**Status pesanan:** `Menunggu → Dimasak → Siap Ambil → Selesai` (+ `Dibatalkan`).

**Seeder** menyediakan data realistis:
- 9 user (5 siswa, 2 penjual: **Daniel** – Kantin Mama, **Acek** – Kantin SMK)
- 4 kategori
- 2 stand kantin (Kantin Mama di Lantai 1, Kantin SMK di Lantai 2)
- 6 menu (3 per stand: Kantin Mama = Nasi Jeruk Cabe Garam, Nasi Ayam Geprek, Es Teh Manis; Kantin SMK = Nasi Kuning, Nasi Goreng, Es Teh Tawar) dengan harga, stok, dan penanda "terlaris"
- Contoh pesanan dengan status beragam (untuk demo dashboard penjual)

---

## 3. Backend

| Komponen | File | Keterangan |
|---|---|---|
| Model | `app/Models/*` | `User`, `Stall`, `Category`, `Menu`, `Order`, `OrderItem` + relasi & helper (`isVendor`, `status_label`, dsb.) |
| Migrasi | `database/migrations/` | 6 migrasi domain + modifikasi tabel users |
| Seeder | `database/seeders/DatabaseSeeder.php` | Data demo lengkap |
| Controller | `CanteenController` | Home, Menu (filter $ kategori + pencarian), detail Stand |
| Controller | `OrderController` | Buat pesanan, kode unik 4 digit, sukses/bukti, riwayat, lacak, batalkan |
| Controller | `VendorController` | Dashboard penjual + update status pesanan |
| Controller | `AuthController` | Register, login, logout custom |
| Middleware | `RoleMiddleware` | Pembatas akses `siswa` / `vendor` |
| Routing | `routes/web.php` | Seluruh route publik, auth, siswa, dan vendor (ber-prefix `/vendor`) |

**Logika penting:**
- Generator kode unik 4 digit (`0000–9999`) yang pasti unik per hari.
- Nomor pesanan format `BG-YYYYMMDD-XXXXX`.
- Stok menu otomatis berkurang saat pesan & kembali saat dibatalkan (hanya pesanan `Menunggu`).
- Pesanan hanya bisa dibatalkan sebelum diproses penjual.
- Siswa tidak bisa membuka dashboard penjual (403) dan sebaliknya.

---

## 4. Frontend (Blade + Tailwind CSS)

Gaya visual mengikuti identitas BiteGo — **Fresh Mint** (#004D40/#00BFA5/#E8F5E9) dengan **Sunlight Yellow** (#FDE047) sebagai aksen.

Halaman yang dibangun:

| Halaman | Path | Fitur |
|---|---|---|
| `layouts/app.blade.php` | — | Layout side bar responsif, flash message, navigasi dinamis sesuai role |
| Home | `/` | Hero, penjelasan 3 langkah, kategori, grid stand kantin, menu terlaris, CTA |
| Menu | `/menu` | Tab kategori, pencarian, kartu menu dengan stok & tombol pesan |
| Detail Stand | `/stall/{slug}` | Info stand, daftar menu, info Express Pickup |
| Buat Pesanan | `/order/{menu}/create` | Proses 3 langkah, stepper jumlah, pilih Istirahat I/II, catatan, ringkasan total |
| Bukti Pesanan | `/orders/{id}/success` | **Kode unik 4 digit** besar, ringkasan, tombol lacak |
| Pesanan Saya | `/orders` | Daftar pesanan + badge status + batal |
| Lacak Pesanan | `/orders/{id}` | Timeline status visual (Menunggu → Dimasak → Siap Ambil) |
| Dashboard Penjual | `/vendor` | Kartu statistik + pendapatan, filter tab status, aksi majukan status tiap pesanan |
| Kelola Menu & Stok | `/vendor/menu` | Tambah/hapus menu, ubah harga & stok, toggle tersedia/terlaris, statistik stok per stand |
| Login / Register | `/login`, `/register` | Autentikasi + akun demo |

---

## 5. Pengujian & Verifikasi

- **Pest / Feature Test (18/18 lulus)** di `tests/Feature/`:
  - `OrderingTest`: home/menu/stand, guest diarahkan ke login, siswa memesan + kode unik, siswa diblokir dari vendor (403), penjual menggeser status, siswa membatalkan pesanan & stok kembali
  - `VendorMenuManagementTest`: halaman kelola menu, penambahan menu (validasi duplikat nama & data salah), ubah harga/stok/toggle, hapus menu, keamanan silang antar penjual (403), akses siswa diblokir (403)
- **HTTP smoke test** end-to-end: register → login siswa → pesan → kode muncul → riwayat → login penjual → dashboard → update status `Menunggu → Dimasak → Siap Ambil → Selesai` ✅
- **Pint** (Laravel code style) diterapkan — seluruh kode lolos format.
- Database `bitego`, `bitego_test`, dan server dev diverifikasi aktif.

---

## 6. Cara Menjalankan

```sh
# 1. Pastikan MySQL aktif
# 2. Atur .env (sudah diset: DB bitego, root, tanpa password)
php artisan key:generate        # jika APP_KEY kosong
php artisan migrate --seed      # buat tabel + data demo
php artisan serve               # → http://127.0.0.1:8000
```

> Catatan: database `bitego` dibuat otomatis oleh MySQL bila belum ada; `migrate` akan membangun seluruh tabel.

---

## 7. Akun Demo

| Role | Email | Password |
|---|---|---|
| Siswa | `galih@bitego.test` | `password` |
| Penjual (Kantin Mama) | `daniel@bitego.test` | `password` |
| Penjual (Kantin SMK) | `acek@bitego.test` | `password` |

Akun lain: `sinta@bitego.test`, `rizky@bitego.test`, `ayu@bitego.test`, `bima@bitego.test` (siswa, semua `password`).

---

## 8. Catatan Teknis

- **PHP 8.4 · Laravel 13 · MySQL 8 · Tailwind CSS v4 (via Vite/build lokal, bukan CDN) · FontAwesome**
- Halaman menggunakan indentasi jelas dan komentar Bahasa Indonesia.
- Styling memakai `resources/css/app.css` (palet tema `mint-*`/`sunshine-*` di `@theme`) dan di-build dengan `npm run build` → hasil di `public/build` (tanpa perlu `npm run dev` saat dipakai).
- Gambar dari Unsplash punya fallback otomatis (kotak + ikon 🍱) jika CDN gambar tidak terjangkau.
- Konfigurasi test di `phpunit.xml` diarahkan ke database `bitego_test` agar uji terisolasi dari data utama.

---

*Dibuat sebagai dokumentasi singkat progres pengembangan BiteGo — Smart Canteen Experience, Bebas Antre.*