# Response Cache Configuration

## ✅ Setup Response Cache

Response cache sudah dikonfigurasi untuk meningkatkan performa website portfolio dengan caching halaman frontend.

## 📋 Konfigurasi

### 1. **Cache Profile Custom** (`app/Http/Middleware/CacheProfile.php`)
- ✅ **Exclude Admin Panel**: Route `/admin*` tidak di-cache
- ✅ **Exclude Livewire**: Route `/livewire/*` tidak di-cache  
- ✅ **Exclude POST Requests**: Form submissions tidak di-cache
- ✅ **Cache GET Requests**: Hanya cache GET requests dengan status 200

### 2. **Middleware Registration** (`bootstrap/app.php`)
Response cache middleware sudah diregister untuk web routes.

### 3. **Auto Clear Cache** (`app/Providers/ResponseCacheServiceProvider.php`)
Cache otomatis di-clear ketika ada perubahan di:
- Projects
- Services
- Skills
- Experiences
- Posts

## ⚙️ Konfigurasi File

### `config/responsecache.php`

```php
'enabled' => env('RESPONSE_CACHE_ENABLED', true),
'cache_lifetime_in_seconds' => 60 * 60 * 24, // 24 jam
'cache_store' => 'file', // Menggunakan file cache
```

### Environment Variables (`.env`)

Tambahkan ke file `.env`:

```env
RESPONSE_CACHE_ENABLED=true
RESPONSE_CACHE_LIFETIME=86400
RESPONSE_CACHE_DRIVER=file
```

## 🚀 Cara Menggunakan

### Clear Cache Manual

```bash
# Clear semua response cache
php artisan responsecache:clear

# Clear cache via code
\Spatie\ResponseCache\Facades\ResponseCache::clear();
```

### Disable Cache

Set di `.env`:
```env
RESPONSE_CACHE_ENABLED=false
```

### Test Cache

1. Akses halaman frontend (misal: `/`, `/portfolio`, `/blog`)
2. Response akan di-cache untuk 24 jam
3. Request berikutnya akan lebih cepat karena menggunakan cache

## 📝 Routes yang Di-Cache

✅ **Di-cache:**
- `/` (Home)
- `/about`
- `/services`
- `/portfolio`
- `/skills`
- `/experience`
- `/blog`
- `/contact` (GET request)

❌ **Tidak di-cache:**
- `/admin/*` (Admin panel)
- `/livewire/*` (Livewire requests)
- POST requests
- Non-200 responses

## 🔧 Customization

### Mengubah Cache Lifetime

Edit `config/responsecache.php`:
```php
'cache_lifetime_in_seconds' => 60 * 60 * 2, // 2 jam
```

Atau via `.env`:
```env
RESPONSE_CACHE_LIFETIME=7200
```

### Menambahkan Route Exclusion

Edit `app/Http/Middleware/CacheProfile.php`:
```php
public function shouldCacheRequest(Request $request): bool
{
    // Tambahkan exclusion baru
    if ($request->is('api/*')) {
        return false;
    }
    
    // ... existing code
}
```

### Mengubah Cache Store

Edit `config/responsecache.php`:
```php
'cache_store' => env('RESPONSE_CACHE_DRIVER', 'redis'), // Gunakan Redis
```

## 📊 Performance Benefits

- ⚡ **Faster Response Time**: Halaman di-cache, response lebih cepat
- 💾 **Reduced Server Load**: Mengurangi beban database dan processing
- 🎯 **Better User Experience**: Loading time lebih cepat untuk user

## ⚠️ Catatan Penting

1. **Cache Auto-Clear**: Cache otomatis di-clear ketika ada perubahan data
2. **Admin Panel**: Tidak di-cache untuk memastikan data selalu up-to-date
3. **Livewire**: Tidak di-cache karena menggunakan real-time updates
4. **Development**: Disable cache saat development untuk debugging

## 🧪 Testing

Test response cache:

```bash
# 1. Clear cache
php artisan responsecache:clear

# 2. Akses halaman
curl http://localhost:8000/

# 3. Akses lagi (seharusnya lebih cepat)
curl http://localhost:8000/
```

Response cache sudah siap digunakan! 🎉

