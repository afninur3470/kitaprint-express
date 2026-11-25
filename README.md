# KitaPrint Express 🖨️🚀
**Platform Cetak Dokumen Berbasis Aplikasi Mobile & Web Dashboard**

KitaPrint Express adalah platform digital yang menghubungkan Pengguna Umum (Mahasiswa/Masyarakat), Tenant Fotocopy, dan Kurir Mahasiswa. Kami menyediakan solusi pemesanan cetak dokumen kilat antar-jemput dengan fitur AI Live Preview, Share Lock Pinpoint, Splitbill, dan Layanan Express.

## 👥 Tim Pengembang
*   Nadya Cahya Eriani (2357201019)
*   Lili Mahdania (2357201025)
*   Nur Afni (2357201001)
*   Ferly Salsabilla Siregar (2357201015)
*   Oktari Nurherfanny (2357201012)
*   David Hans Sitorus (2357201035)
*   Ricki Saputra (2357201031)

*Program Studi Sistem Informasi, Fakultas Ilmu Komputer, Universitas Lancang Kuning, 2026.*

## 🛠️ Tech Stack
*   **Frontend Mobile:** Flutter / React Native (Pengguna & Kurir)
*   **Frontend Web (Dashboard):** Blade / Vue.js via Laravel (Mitra/Toko & Koordinator)
*   **Backend:** PHP 8.x dengan Framework **Laravel**
*   **Database:** **MySQL**
*   **Integrasi:** Maps API, QRIS/GoPay/DANA Payment Gateway, Firebase (Push Notifikasi).

## 📂 Struktur Repositori
*   `01_Business_Plan/`: Dokumen proposal bisnis lengkap (BAB I-V).
*   `02_Presentation/`: File PPT dan naskah presentasi.
*   `03_System_Analysis/`: Flowchart (PlantUML), State Machine, dan ERD.
*   `04_UI_UX_Design/`: Link Figma dan *prompt* desain antarmuka.
*   `05_Backend_Laravel/`: *Source code* API dan Web Dashboard (Laravel).

## 🚀 Cara Menjalankan Project (Backend Laravel)
*(Bagian ini diisi nanti setelah folder Laravel diinisialisasi)*
1. Clone repo ini: `git clone https://github.com/username/kitaprint-express.git`
2. Masuk ke folder: `cd 05_Backend_Laravel`
3. Jalankan `composer install`
4. Copy `.env.example` ke `.env` dan atur koneksi database MySQL.
5. Jalankan `php artisan migrate` dan `php artisan serve`.
