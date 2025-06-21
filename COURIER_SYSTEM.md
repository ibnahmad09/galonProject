# Sistem Kurir - Galon Project

## Overview
Sistem kurir telah dibuat dengan fitur lengkap untuk mengelola pengiriman galon air. Kurir dapat melihat dashboard, menerima pengiriman, update status, dan melihat riwayat pengiriman.

## Fitur Utama

### 1. Dashboard Kurir
- **Statistik Pengiriman**: Menampilkan jumlah pengiriman aktif, selesai hari ini, dan total bulan ini
- **Pengiriman Aktif**: Daftar pengiriman yang sedang berlangsung
- **Notifikasi**: Notifikasi terbaru untuk kurir
- **Update Status**: Modal untuk mengupdate status pengiriman langsung dari dashboard

### 2. Manajemen Pengiriman
- **Semua Pengiriman**: Daftar lengkap semua pengiriman dengan filter dan search
- **Pengiriman Tersedia**: Pengiriman yang belum diterima kurir lain
- **Detail Pengiriman**: Informasi lengkap pengiriman termasuk customer dan item
- **Riwayat Pengiriman**: Statistik dan riwayat pengiriman selesai

### 3. Status Pengiriman
- `pending` - Menunggu kurir
- `assigned` - Diterima kurir
- `picked_up` - Barang diambil
- `on_way` - Dalam perjalanan
- `delivered` - Berhasil dikirim
- `failed` - Gagal dikirim

## Struktur Database

### Tabel Deliveries
```sql
- id (Primary Key)
- order_id (Foreign Key ke orders)
- courier_id (Foreign Key ke users, nullable)
- status (enum: pending, assigned, picked_up, on_way, delivered, failed)
- tracking_number (unique)
- notes (text, nullable)
- created_at, updated_at
```

## Routes

### Courier Routes
```php
GET  /courier/dashboard              - Dashboard kurir
GET  /courier/deliveries             - Semua pengiriman
GET  /courier/delivery/{id}          - Detail pengiriman
POST /courier/delivery/{id}/status   - Update status pengiriman
GET  /courier/available-deliveries   - Pengiriman tersedia
POST /courier/delivery/{id}/accept   - Terima pengiriman
GET  /courier/delivery-history       - Riwayat pengiriman
POST /courier/notifications/{id}/mark-read - Mark notifikasi sebagai dibaca
```

## Controller Methods

### CourierController
- `dashboard()` - Dashboard dengan statistik dan pengiriman aktif
- `deliveries()` - Daftar semua pengiriman dengan pagination
- `deliveryDetail($id)` - Detail pengiriman
- `updateDeliveryStatus()` - Update status pengiriman
- `acceptDelivery()` - Terima pengiriman baru
- `availableDeliveries()` - Pengiriman yang tersedia
- `deliveryHistory()` - Riwayat pengiriman
- `markNotificationAsRead()` - Mark notifikasi sebagai dibaca

## Views

### Layout
- `resources/views/layouts/courier.blade.php` - Layout utama kurir

### Pages
- `resources/views/courier/dashboard.blade.php` - Dashboard
- `resources/views/courier/deliveries.blade.php` - Semua pengiriman
- `resources/views/courier/available-deliveries.blade.php` - Pengiriman tersedia
- `resources/views/courier/delivery-detail.blade.php` - Detail pengiriman
- `resources/views/courier/delivery-history.blade.php` - Riwayat pengiriman

## Middleware
- `CourierMiddleware` - Memastikan hanya user dengan role 'courier' yang bisa akses

## Seeder Data
- **UserSeeder**: Membuat 2 akun kurir (courier1@galon.com, courier2@galon.com)
- **DeliverySeeder**: Membuat data pengiriman contoh

## Login Kurir
```
Email: courier1@galon.com
Password: password

Email: courier2@galon.com  
Password: password
```

## Fitur Tambahan

### Notifikasi
- Notifikasi real-time untuk status pengiriman
- Notifikasi untuk admin saat kurir update status
- Notifikasi untuk customer saat pengiriman selesai

### Tracking
- Tracking number unik untuk setiap pengiriman
- Timeline status pengiriman
- Catatan pengiriman

### UI/UX
- Responsive design dengan Bootstrap 5
- Sidebar navigation
- Status badges dengan warna berbeda
- Modal untuk update status
- Search dan filter functionality
- Pagination untuk data besar

## Cara Penggunaan

1. **Login sebagai Kurir**
   - Akses `/courier/dashboard`
   - Login dengan email dan password kurir

2. **Terima Pengiriman**
   - Klik "Pengiriman Tersedia" di sidebar
   - Klik "Terima Pengiriman" pada pengiriman yang diinginkan

3. **Update Status**
   - Dari dashboard atau daftar pengiriman
   - Klik tombol edit (ikon pensil)
   - Pilih status baru dan tambahkan catatan jika perlu

4. **Lihat Riwayat**
   - Klik "Riwayat Pengiriman" di sidebar
   - Lihat statistik dan grafik pengiriman

## Keamanan
- Middleware untuk memastikan hanya kurir yang bisa akses
- Validasi input untuk update status
- CSRF protection untuk semua form
- Authorization untuk setiap action

## Dependencies
- Laravel 10
- Bootstrap 5
- Font Awesome 6
- jQuery 3.6
- Chart.js (untuk grafik statistik) 
