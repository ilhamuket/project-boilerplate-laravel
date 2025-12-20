# Laravel Boilerplate — FrankenPHP Edition

Boilerplate Laravel modern berbasis Docker + FrankenPHP (Caddy). Dirancang untuk aplikasi internal/enterprise (HR, Budgeting, Surat, dll) dengan fokus pada kecepatan, reusability, stabilitas, dan performa aman.

## ✨ Tech Stack

- Laravel 12
- PHP 8.4+ (FrankenPHP)
- Caddy (built-in web server)
- MySQL 8
- Redis
- Vite
- Docker & Docker Compose

## 🎯 Tujuan Boilerplate

- Start project dalam hitungan menit
- Struktur rapi & konsisten antar project
- Tidak memberatkan server
- Aman dipakai sampai production
- Mudah dikembangkan (monolith-friendly)

## 📦 Fitur Bawaan

### Core
- Authentication (Laravel Breeze)
- Role & Permission (Spatie)
- Activity Log (Spatie)
- Redis-ready (cache & session)
- MySQL ready
- Queue ready (sync → redis)

### Reporting
- Excel export (Maatwebsite)
- PDF ready (Dompdf)

### Developer Experience
- Dockerized (1 command up)
- Makefile commands
- Code formatter (Laravel Pint)
- Vite dev server
- Clean environment separation

## 📁 Struktur Direktori Penting

```
app/
 ├── Actions/        # Business logic kecil & reusable
 ├── Services/       # Service layer
 ├── Exports/        # Excel exports
 ├── Http/
 │   ├── Controllers/
 │   └── Middleware/
resources/
 ├── views/
 │   ├── layouts/
 │   ├── pdf/
 │   │   └── letters/
docker/
 ├── php.ini
 ├── Caddyfile
Makefile
docker-compose.yml
```

## ⚙️ Requirements

- Docker
- Docker Compose

*Tidak perlu PHP / MySQL di host*

## 🚀 Quick Start

```bash
make up
make init
```

**Akses aplikasi:**
- App: http://localhost:8080
- Vite: http://localhost:5173

## 🧰 Makefile Commands

### Container
```bash
make up              # Start containers
make down            # Stop containers
make restart         # Restart containers
make logs            # View logs
make sh              # Shell ke container app
```

### Laravel
```bash
make migrate
make migrate-fresh
make cache-clear
make optimize
```

### Code Quality
```bash
make pint            # Auto format code
make pint-test       # Check formatting (CI-ready)
make check           # Run all checks
```

## 🔐 Authentication & Authorization

- **Authentication:** Laravel Breeze
- **Authorization:** Spatie Laravel Permission

### Middleware
- `role`
- `permission`

Siap untuk Admin, User, dan Approval-based role.

## 📊 Activity Log

Menggunakan **Spatie Activity Log** untuk:
- Audit trail
- Tracking perubahan data
- Approval history

## 📄 PDF & Excel

### PDF
- Dompdf sudah terpasang
- Template disarankan di: `resources/views/pdf/`

### Excel
- Maatwebsite Excel terpasang
- Export class disimpan di: `app/Exports/`

## 🌱 Environment Configuration

```env
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=sync
```

Untuk production, gunakan `QUEUE_CONNECTION=redis`.

## 🔧 Production Notes

- Pastikan `APP_DEBUG=false`
- Jangan aktifkan debug tools di production
- FrankenPHP sudah include OPcache
- Redis digunakan untuk cache & session (ringan & cepat)

## 🧠 Best Practices

- Controller tipis
- Logic bisnis di Actions / Services
- Hindari menyimpan state di singleton
- Gunakan queue untuk proses berat
- Jalankan `make pint` sebelum commit

## 🧩 Cocok Untuk

- Sistem Kepegawaian
- Budgeting & Approval
- Surat menyurat
- Internal tools perusahaan
- Aplikasi monolith skala menengah

## 📌 Lisensi

Internal / Private. Gunakan dan modifikasi sesuai kebutuhan project.

## 👋 Catatan Akhir

Boilerplate ini sengaja tidak terlalu banyak fitur. Tujuannya adalah fondasi kuat, fleksibel, dan tahan lama. Tambahkan fitur saat dibutuhkan, bukan di awal.

Happy coding 🚀
