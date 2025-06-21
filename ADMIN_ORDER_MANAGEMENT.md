# Manajemen Pesanan Admin - Galon Project

## Overview
Fitur manajemen pesanan untuk admin telah diperbarui dengan kemampuan untuk mengelola pesanan, assign kurir, dan mengirim notifikasi ke kurir untuk melakukan pengantaran.

## Fitur Utama

### 1. Dashboard Admin yang Diperbarui
- **Statistik Lengkap**: Total pesanan, produk, pesanan pending, dan pengiriman
- **Statistik Pengiriman**: Pengiriman aktif, selesai, dan tingkat keberhasilan
- **Quick Actions**: Link cepat ke manajemen pesanan, pengiriman, dan produk
- **Pesanan Terbaru**: Daftar pesanan terbaru dengan status pengiriman

### 2. Manajemen Pesanan
- **Daftar Pesanan**: Tampilan lengkap semua pesanan dengan pagination
- **Detail Pesanan**: Informasi lengkap pesanan, customer, dan item
- **Update Status**: Mengubah status pesanan (pending, processing, delivered, cancelled)
- **Assign Kurir**: Menugaskan kurir untuk pengiriman
- **Filter dan Search**: Mencari pesanan berdasarkan tracking number

### 3. Manajemen Pengiriman
- **Daftar Pengiriman**: Monitor semua pengiriman dengan status
- **Detail Pengiriman**: Informasi lengkap pengiriman dan kurir
- **Statistik Pengiriman**: Tracking status pengiriman

### 4. Sistem Notifikasi
- **Notifikasi ke Kurir**: Otomatis saat pesanan status 'processing'
- **Notifikasi Assign**: Saat kurir ditugaskan
- **Notifikasi Pembatalan**: Saat kurir diganti

## Alur Kerja

### 1. Pesanan Masuk
1. Customer membuat pesanan
2. Admin melihat pesanan di dashboard
3. Admin mengubah status menjadi 'processing'
4. Sistem otomatis mengirim notifikasi ke semua kurir

### 2. Assign Kurir
1. Admin memilih kurir dari daftar
2. Admin assign kurir ke pesanan
3. Kurir menerima notifikasi pengiriman baru
4. Status pengiriman berubah menjadi 'assigned'

### 3. Tracking Pengiriman
1. Kurir update status pengiriman
2. Admin dapat monitor progress
3. Customer dapat lihat status real-time

## Routes Baru

### Admin Routes
```php
GET  /admin/orders/{id}                    - Detail pesanan
GET  /admin/deliveries                     - Daftar pengiriman
GET  /admin/deliveries/{id}                - Detail pengiriman
POST /admin/orders/{orderId}/assign-courier - Assign kurir
```

## Controller Methods Baru

### AdminController
- `orderDetail($id)` - Detail pesanan dengan informasi lengkap
- `assignCourier()` - Assign kurir dengan notifikasi
- `deliveries()` - Daftar semua pengiriman
- `deliveryDetail($id)` - Detail pengiriman
- `notifyCouriersForDelivery()` - Kirim notifikasi ke kurir

## Views Baru

### Admin Views
- `resources/views/admin/orders/detail.blade.php` - Detail pesanan
- `resources/views/admin/deliveries/index.blade.php` - Daftar pengiriman
- `resources/views/admin/deliveries/detail.blade.php` - Detail pengiriman

### Updated Views
- `resources/views/admin/dashboard.blade.php` - Dashboard dengan statistik pengiriman
- `resources/views/admin/orders/index.blade.php` - Daftar pesanan dengan assign courier

## Status Pesanan

### Order Status
- `pending` - Menunggu diproses
- `processing` - Sedang diproses (kirim notifikasi ke kurir)
- `delivered` - Selesai dikirim
- `cancelled` - Dibatalkan

### Delivery Status
- `pending` - Menunggu kurir
- `assigned` - Diterima kurir
- `picked_up` - Barang diambil
- `on_way` - Dalam perjalanan
- `delivered` - Berhasil dikirim
- `failed` - Gagal dikirim

## Fitur Notifikasi

### Jenis Notifikasi
1. **new_delivery_available** - Pengiriman baru tersedia
2. **delivery_assigned** - Kurir ditugaskan
3. **delivery_cancelled** - Pengiriman dibatalkan
4. **delivery_status_updated** - Status pengiriman diupdate
5. **delivery_completed** - Pengiriman selesai

### Trigger Notifikasi
- Status pesanan berubah ke 'processing'
- Kurir di-assign ke pengiriman
- Kurir update status pengiriman
- Pengiriman selesai

## Cara Penggunaan

### 1. Login sebagai Admin
```
Email: admin@galon.com
Password: password
```

### 2. Kelola Pesanan
1. Buka `/admin/orders`
2. Lihat daftar pesanan
3. Klik detail untuk informasi lengkap
4. Update status pesanan
5. Assign kurir jika diperlukan

### 3. Monitor Pengiriman
1. Buka `/admin/deliveries`
2. Lihat status semua pengiriman
3. Klik detail untuk informasi lengkap
4. Monitor progress pengiriman

### 4. Dashboard Overview
1. Buka `/admin/dashboard`
2. Lihat statistik lengkap
3. Gunakan Quick Actions untuk navigasi cepat
4. Monitor pesanan terbaru

## Keamanan

### Authorization
- Middleware admin untuk semua route admin
- Validasi input untuk assign courier
- CSRF protection untuk semua form

### Data Validation
- Validasi courier_id saat assign
- Validasi status pesanan
- Sanitasi input user

## Integrasi dengan Sistem Kurir

### Notifikasi Real-time
- Kurir menerima notifikasi saat ada pengiriman baru
- Kurir dapat melihat pengiriman yang tersedia
- Admin dapat monitor aktivitas kurir

### Tracking System
- Admin dapat lihat status pengiriman real-time
- Customer dapat track pesanan
- Kurir dapat update status dengan catatan

## Dependencies
- Laravel 10
- Bootstrap 5
- Font Awesome 6
- jQuery 3.6
- Database dengan relasi yang sudah diatur

## Database Changes
- Tabel `deliveries` dengan field `notes`
- Tabel `notifications` untuk sistem notifikasi
- Relasi antara `orders`, `deliveries`, `users`, dan `notifications`

## Testing
1. Buat pesanan sebagai customer
2. Login sebagai admin
3. Lihat pesanan di dashboard
4. Update status ke 'processing'
5. Assign kurir
6. Login sebagai kurir
7. Lihat notifikasi dan pengiriman
8. Update status pengiriman
9. Monitor dari sisi admin

## Troubleshooting
- Pastikan semua migration sudah dijalankan
- Periksa relasi database
- Pastikan middleware admin berfungsi
- Periksa notifikasi di database 
