# Bayaran - HRIS Software

**Bayaran** is a web-based Human Resource Information System (HRIS) application built with the Laravel framework. It is designed to help companies efficiently manage employee data, attendance, payroll, KPIs, and various other HR-related features.

## 🌐 Application Demo

🔗 [https://bayaran.hendrypk.my.id](https://bayaran.hendrypk.my.id)

**Admin Demo Account:**
- **Username:** `administrator`
- **Password:** `administrator`

---

**Employee Demo Account:**
- **Username:** `hendry5`
- **Password:** `hendry5`

---

## 🚀 Fitur Utama
- Employee Data Management
- Work Schedule & Attendance
- Monthly Payroll Calculation
- KPI (Key Performance Indicator) Management
- Performance Appraisal
- Overtime & Leave Management
- Login System & Role-Based Access Control

---

## 🛠️ Technologies Used

- **Framework:** Laravel
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap
- **Others:** jQuery, AJAX, DataTables

---

## 📥 Installation & Running The Project

**1. Clone the repository**
```bash
git clone https://github.com/hendrypk/bayaran.git
```

**2. Navigate into the project directory**
```bash
cd bayaran
```
**3. Install PHP dependencies**
```bash
composer install
```

**4. Copy the .env file**
```bash
cp .env.example .env
```
**5. Generate application key**
```bash
php artisan key:generate
```
**6. Configure your .env file according your database setting**
```bash
DB_DATABASE=bayaran
DB_USERNAME=root
DB_PASSWORD=
```

**7. Run migration & seeder**
```bash
php artisan migrate --seed
```
** Start the local development server**
```bash
php artisan serve
```