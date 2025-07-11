# RELOKA

**RELOKA** adalah aplikasi e-commerce sederhana yang dikembangkan sebagai bahan ajar untuk mata kuliah **Pemrograman Web 2** di Politeknik Harapan Bersama Tegal.

## 🚀 Fitur Utama

- Manajemen Kategori Produk
- Manajemen Produk
- Login & Registrasi Customer
- Keranjang Belanja
- Proses Checkout
- Dashboard Customer

## 🛠️ Instalasi

1. **Clone** repository ini:
    ```bash
    git clone https://github.com/Ryknabdr/RELOKA.git
    cd RELOKA
    ```

2. **Install dependency PHP:**
    ```bash
    composer install
    ```

3. **Install dependency frontend dan jalankan dev server:**
    ```bash
    npm install
    ```

4. **Konfigurasi database:**
    - Salin file `.env.example` menjadi `.env`
    - Atur konfigurasi database sesuai pengaturan lokal kamu

5. **Jalankan migrasi database:**
    ```bash
    php artisan migrate
    ```

6. **Jalankan server development:**
    ```bash
    php artisan serve
    ```

7. (Opsional) Jika menggunakan Vite untuk frontend:
    ```bash
    npm run dev
    ```

## 🤝 Kontribusi

Kontribusi sangat terbuka untuk pengembangan lebih lanjut.  
Silakan buat pull request atau laporkan issue jika menemukan bug atau ingin menambahkan fitur.

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan tidak untuk penggunaan komersial.

