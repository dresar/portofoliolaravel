# Instruksi Setup Portfolio Website

## 📋 Persyaratan
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite (sudah termasuk di PHP)

## 🚀 Langkah-langkah Setup

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

```bash
# Copy file .env jika belum ada
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Setup Database

```bash
# Pastikan file database.sqlite sudah ada
touch database/database.sqlite

# Jalankan migrations
php artisan migrate
```

### 4. Install FilamentPHP Admin Panel

```bash
php artisan filament:install --panels
```

Saat diminta, pilih:
- **Panel ID**: `admin` (atau tekan Enter untuk default)
- **Username**: `admin` (atau username pilihan Anda)
- **Email**: `admin@example.com` (atau email pilihan Anda)
- **Password**: Buat password yang kuat

### 5. Buat User Admin (Alternatif)

Jika Anda ingin membuat user admin secara manual:

```bash
php artisan make:filament-user
```

### 6. Setup Storage Link (untuk upload file)

```bash
php artisan storage:link
```

### 7. Build Assets

```bash
npm run build
```

Atau untuk development dengan hot reload:

```bash
npm run dev
```

### 8. Jalankan Server

```bash
php artisan serve
```

Website akan tersedia di: `http://localhost:8000`
Admin Panel akan tersedia di: `http://localhost:8000/admin`

## 📝 Cara Menggunakan Admin Panel

1. Buka `http://localhost:8000/admin`
2. Login dengan kredensial yang Anda buat
3. Di sidebar, Anda akan melihat menu:
   - **Portfolio**: Projects, Services, Skills, Experiences
   - **Blog**: Posts
   - **Contact**: Messages

4. Tambahkan data untuk setiap section:
   - **Projects**: Tambahkan proyek portfolio dengan gambar, kategori, dan URL
   - **Services**: Tambahkan layanan yang Anda tawarkan
   - **Skills**: Tambahkan skill dengan tingkat proficiency (0-100)
   - **Experiences**: Tambahkan pengalaman kerja/pendidikan
   - **Posts**: Buat artikel blog (jangan lupa set `is_published` = true)
   - **Messages**: Pesan dari form contact akan muncul di sini

## 🎨 Fitur Website

### Frontend Pages (Semua menggunakan `wire:navigate` untuk SPA experience):
1. **Home** (`/`) - Hero section dengan featured projects
2. **About** (`/about`) - Halaman tentang saya
3. **Services** (`/services`) - Daftar layanan
4. **Portfolio** (`/portfolio`) - Grid proyek dengan filter kategori
5. **Skills** (`/skills`) - Daftar skill dengan progress bar
6. **Experience** (`/experience`) - Timeline pengalaman kerja
7. **Blog** (`/blog`) - Daftar artikel blog
8. **Contact** (`/contact`) - Form kontak yang menyimpan ke admin panel

## 🔧 Customization

### Mengubah Informasi Personal:
1. Edit file `resources/views/livewire/home.blade.php` untuk mengubah hero section
2. Edit file `resources/views/livewire/about.blade.php` untuk mengubah informasi tentang
3. Edit file `resources/views/livewire/contact.blade.php` untuk mengubah informasi kontak

### Mengubah Warna Theme:
Edit file `tailwind.config.js` atau gunakan class Tailwind langsung di views.

## 📦 Struktur File Penting

```
app/
├── Filament/Resources/          # Admin Panel Resources
│   ├── ProjectResource.php
│   ├── ServiceResource.php
│   ├── SkillResource.php
│   ├── ExperienceResource.php
│   ├── PostResource.php
│   └── MessageResource.php
├── Livewire/                     # Livewire Components
│   ├── Home.php
│   ├── About.php
│   ├── Services.php
│   ├── Portfolio.php
│   ├── Skills.php
│   ├── Experience.php
│   ├── Blog.php
│   └── Contact.php
└── Models/                       # Eloquent Models

resources/
├── views/
│   ├── components/layouts/       # Layout utama
│   └── livewire/                 # Views untuk Livewire components
└── css/app.css                   # Tailwind CSS

routes/
└── web.php                       # Routes aplikasi
```

## 🐛 Troubleshooting

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Storage link tidak ada
```bash
php artisan storage:link
```

### Error: Migration failed
```bash
php artisan migrate:fresh
```

### Error: Assets tidak ter-load
```bash
npm run build
# atau
npm run dev
```

## 📚 Dokumentasi Tambahan

- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Livewire 3 Documentation](https://livewire.laravel.com/docs)
- [FilamentPHP 3 Documentation](https://filamentphp.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

## ✅ Checklist Setup

- [ ] Composer dependencies terinstall
- [ ] NPM dependencies terinstall
- [ ] File .env sudah dikonfigurasi
- [ ] Database migrations sudah dijalankan
- [ ] Filament admin panel sudah diinstall
- [ ] User admin sudah dibuat
- [ ] Storage link sudah dibuat
- [ ] Assets sudah di-build
- [ ] Server berjalan dengan baik
- [ ] Admin panel bisa diakses
- [ ] Frontend website bisa diakses

Selamat! Portfolio website Anda sudah siap digunakan! 🎉

