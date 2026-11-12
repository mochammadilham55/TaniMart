# TaniMart

**Marketplace hasil pertanian** yang mempertemukan petani langsung dengan pembeli, dibangun dengan Laravel 12 dan MySQL.

## Daftar Isi

- [Tujuan Proyek](#tujuan-proyek)
- [Gambaran Web](#gambaran-web)
- [Fitur](#fitur)
- [Teknis](#teknis)
- [Pembagian Modul](#pembagian-modul)

## Tujuan Proyek

1. **Mempertemukan petani langsung dengan pembeli.** Petani bisa menjual hasil panen secara online tanpa perantara.
2. **Memberi petani alat berjualan yang lengkap.** Mulai dari mengelola produk, memproses pesanan, mengonfirmasi pembayaran, sampai mengirim barang dan melihat laporan penjualan.
3. **Menjaga kualitas dan kepercayaan platform.** Admin memoderasi petani, produk, dan ulasan.

## Gambaran Web

Ada tiga peran dengan dashboard masing-masing:

| Peran   | Tugas                                                        |
|---------|--------------------------------------------------------------|
| Pembeli | Menelusuri katalog, berbelanja, membayar, dan memberi ulasan |
| Petani  | Menjual produk dan mengurus pesanan sampai terkirim          |
| Admin   | Mengawasi seluruh platform                                   |

### Alur Utama

1. Pembeli memilih produk, memasukkannya ke keranjang, lalu checkout.
2. Pembeli membayar (transfer atau COD).
3. Petani mengonfirmasi pesanan dan pembayaran, lalu mengirim barang.
4. Setelah barang tiba, pembeli menyelesaikan pesanan dan menulis ulasan.
5. Admin menyetujui ulasan tersebut sebelum tampil.

## Fitur

### Umum / Publik

- Katalog produk di halaman depan, dan halaman detail produk yang menampilkan rating dan ulasan yang sudah disetujui.
- Registrasi, login, dan logout.
- Setelah login, pengguna diarahkan ke dashboard sesuai perannya.
- Edit profil dan ganti password.

### Pembeli

- **Keranjang:** tambah, ubah jumlah, dan hapus item.
- **Checkout:** alamat kirim, catatan, dan ongkir tetap yang bisa diatur lewat `AGRITANI_SHIPPING_COST` (bawaan Rp10.000).
- **Pesanan:** daftar dan detail pesanan, upload bukti transfer, batalkan pesanan, dan tandai selesai.
- **Ulasan:** beri rating 1-5 dan komentar. Hanya bisa setelah pesanan selesai, dan ulasan bisa diedit.
- **Dashboard** ringkasan.

### Petani

- **Produk:** tambah, ubah, dan hapus produk. Data produk mencakup harga, stok, satuan, berat, dan foto. Produk juga bisa diaktifkan atau dinonaktifkan.
- **Pesanan:** lihat pesanan yang masuk, lalu konfirmasi atau tolak.
- **Pembayaran:** konfirmasi atau tolak bukti pembayaran.
- **Pengiriman:** isi kurir, nomor resi, dan perkiraan tiba, lalu tandai sudah tiba.
- **Laporan penjualan** dengan fitur export, dan dashboard statistik.

### Admin

- **Kelola petani:** aktifkan atau nonaktifkan akun.
- **Kelola produk:** moderasi dan suspend produk, lengkap dengan alasan suspend.
- **Kelola kategori:** CRUD kategori.
- **Pantau** semua pesanan di seluruh platform.
- **Moderasi ulasan:** setujui atau tolak.
- **Laporan platform** dengan export, dan dashboard statistik.

## Teknis

- Akses dibatasi per peran lewat `RoleMiddleware`.
- Route dipisah per modul di `routes/modules/`.
- Test dipisah per modul (Core, PetaniProduk, Pesanan, PembayaranPengiriman, Laporan, Ulasan), dan berjalan di SQLite in-memory.
- `DemoSeeder` menyediakan data contoh untuk mengisi dashboard dan laporan.

## Pembagian Modul

| Modul                             | Penanggung jawab |
|-----------------------------------|------------------|
| Manajemen Petani & Produk         | Dana             |
| Manajemen Pesanan                 | Bagas            |
| Pengiriman & Pembayaran           | Ilham            |
| Laporan                           | Hafid            |
