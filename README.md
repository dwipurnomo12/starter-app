# Laravel Starter App

Starter template untuk memulai proyek Laravel dengan konfigurasi awal dan fitur yang sering digunakan


## Fitur

- Laravel 11.x
- Spatie Role and Permission untuk pengaturan hak akses
- Yajra DataTables untuk tabel dinamis
- Bootstrap 5 sebagai framework CSS
- Struktur folder yang rapi untuk pengembangan
- Pengaturan otentikasi dengan Laravel Breeze/Laravel UI
- Mazer admin template
- Summernote text editor

- PHP >= 8.2
- Composer
- MySQL atau database lain yang kompatibel
- Node.js dan NPM/Yarn


## Installation

Ikuti langkah-langkah berikut untuk menggunakan template ini :
### 1. Clone Repository

```bash
git clone https://github.com/username/starter-template-laravel.git
cd starter-template-laravel
```

### 2. Install Dependensi
Install Dependensi Jalankan perintah berikut untuk mengunduh semua dependensi PHP dan Laravel UI:
```bash
composer install
npm install
npm run dev
```

### 3. Konfigurasi File .Env
Salin file .env.example menjadi .env dan atur konfigurasi database Anda:
```bash
cp .env.example .env
```
Kemudian edit file .env :
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password

```

### 4. Generate Key dan Migrasi Database
Salin file .env.example menjadi .env dan atur konfigurasi database Anda:
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Jalankan server
```bash
php artisan serve
```


## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)


## Screenshot
![Screenshot_834](https://github.com/user-attachments/assets/74989b8e-6171-4239-bab5-cac4d47e2d49)
![Screenshot_833](https://github.com/user-attachments/assets/594a41b5-4ea3-45d3-ba2c-75a0b171f50f)
![Screenshot_835](https://github.com/user-attachments/assets/a617b239-edc5-4a27-9c7e-acf5a8c894ed)![Screenshot_837](https://github.com/user-attachments/assets/49de8f2d-0b40-4393-bcc4-b5c8a2b89ca2)
![Screenshot_836](https://github.com/user-attachments/assets/933f7df5-9805-4b6b-81f4-1481fb8ec627)
