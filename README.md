# App Cek Ongkir

Aplikasi untuk mengecek ongkos kirim dan menemukan agen pengiriman terdekat menggunakan Laravel 11.

## Fitur Utama

1. Menyimpan Database Agen Pengiriman
   - Data agen pengiriman di seluruh kota di Indonesia
   - Informasi lengkap termasuk nama, alamat, koordinat geografis, dan tarif

2. Rekomendasi Agen Terdekat
   - Merekomendasikan agen terdekat berdasarkan alamat yang dipilih
   - Menggunakan perhitungan jarak berdasarkan koordinat geografis

3. Menghitung Ongkir
   - Perhitungan ongkir berdasarkan parameter seperti berat barang, jarak, dan tarif

## Teknologi yang Digunakan

- Laravel 11
- Bootstrap 5
- Leaflet.js untuk peta
- API untuk data wilayah Indonesia
- API Raja Ongkir untuk perhitungan ongkir

## Instalasi

1. Clone repository ini
   ```
   git clone https://github.com/username/app-cek-ongkir.git
   cd app-cek-ongkir
   ```

2. Install dependencies
   ```
   composer install
   npm install
   ```
3. build component
   ```
   npm run build
   ```
4. migration table and seeder
   ```
   php artisan migrate --seed
   ```
5. Salin file .env.example menjadi .env dan atur konfigurasi
   ```
   cp .env.example .env
   php artisan key:generate
   ```

6. Konfigurasi database di file .env
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=app_cek_ongkir
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Atur API key RajaOngkir dan URL API Wilayah Indonesia di file .env
   ```
   RAJAONGKIR_API_KEY=your_api_key
   INDONESIA_REGION_API_URL=http://127.0.0.1:9000
   ```

8. Jalankan migrasi dan seeder
   ```
   php artisan migrate --seed
   ```

9. Kompilasi assets
   ```
   npm run dev
   ```

10. Jalankan aplikasi
   ```
   php artisan serve
   ```

11. Buka aplikasi di browser: `http://localhost:8000`

## Struktur Proyek

- `app/Services/RegionService.php` - Service untuk mengambil data wilayah dari API
- `app/Services/RajaOngkirService.php` - Service untuk mengakses API Raja Ongkir
- `app/Models/Agent.php` - Model untuk data agen pengiriman
- `app/Http/Controllers/HomeController.php` - Controller untuk halaman web
- `app/Http/Controllers/Api/RegionController.php` - Controller untuk API wilayah
- `app/Http/Controllers/Api/ShippingController.php` - Controller untuk API pengiriman

## API Endpoints

### API Wilayah Indonesia

- `GET /api/provinces` - Daftar provinsi
- `GET /api/provinces/{province_id}/regencies` - Daftar kabupaten/kota dalam provinsi
- `GET /api/provinces/{province_id}/regencies/{regency_id}/districts` - Daftar kecamatan dalam kabupaten/kota
- `GET /api/provinces/{province_id}/regencies/{regency_id}/districts/{district_id}/villages` - Daftar desa/kelurahan dalam kecamatan

### API Pengiriman

- `GET /api/shipping/destination` - Mencari destinasi pengiriman
- `POST /api/shipping/calculate` - Menghitung biaya pengiriman
- `GET /api/shipping/nearest-agents` - Mendapatkan agen terdekat berdasarkan koordinat

## Pengembangan Lebih Lanjut

- Integrasi dengan lebih banyak penyedia jasa pengiriman
- Fitur tracking pengiriman
- Fitur estimasi waktu pengiriman
- Aplikasi mobile menggunakan framework seperti Flutter atau React Native
