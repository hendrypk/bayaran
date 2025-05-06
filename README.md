# Bayaran - HRIS Software

**Bayaran** adalah aplikasi Human Resource Information System (HRIS) berbasis web yang dibangun menggunakan framework **Laravel**. Aplikasi ini dirancang untuk membantu perusahaan dalam mengelola data karyawan, kehadiran, penggajian, KPI, dan berbagai fitur lainnya yang berkaitan dengan HR secara efisien.

## 🌐 Demo Aplikasi

🔗 [https://bayaran.hendrypk.my.id](https://bayaran.hendrypk.my.id)

**Akun Demo:**
- **Username:** `administrator`
- **Password:** `administrator`

---

## 🚀 Fitur Utama

- Manajemen Data Karyawan
- Jadwal Kerja & Kehadiran
- Penghitungan Gaji Bulanan
- Pengelolaan KPI (Key Performance Indicator)
- Penilaian Performance Appraisal
- Lembur & Cuti
- Sistem Login & Role-Based Access

---

## 🛠️ Teknologi

- **Framework:** Laravel
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap
- **Lainnya:** jQuery, AJAX, DataTables

---

## 📥 Cara Install & Jalankan

```bash
# Clone repository
git clone https://github.com/hendrypk/bayaran.git

# Masuk ke direktori project
cd bayaran

# Install dependensi PHP
composer install

# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate

# Konfigurasi file .env sesuai database kamu
# DB_DATABASE=bayaran
# DB_USERNAME=root
# DB_PASSWORD=

# Jalankan migrasi dan seeder
php artisan migrate --seed
php artisan db:seed --clas=PermissionsDemoSeeder

# Jalankan server lokal
php artisan serve
