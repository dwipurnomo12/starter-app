# Laravel starter App

Starter template untuk memulai proyek Laravel dengan konfigurasi awal dan fitur yang sering digunakan.

## Fitur
- Laravel 11.x
- Spatie Role and Permission untuk pengaturan hak akses
- Yajra DataTables untuk tabel dinamis
- Mazer Admin Dashboard
- Bootstrap 5 sebagai framework CSS
- Struktur folder yang rapi untuk pengembangan
- Pengaturan otentikasi dengan Laravel UI
- Realrashid Sweet Alert
- Summernote text editor

## Prasyarat
- PHP >= 8.1
- Composer
- MySQL database
- Node.js dan NPM/Yarn

## Installation

Ikuti langkah-langkah berikut untuk menggunakan template ini:

```bash
git clone https://github.com/username/starter-template-laravel.git
cd starter-template-laravel
```

Install Dependensi Jalankan perintah berikut untuk mengunduh semua dependensi PHP dan frontend:
```bash
composer install
npm install
npm run dev
```

Konfigurasi File .env Salin file .env.example menjadi .env dan atur konfigurasi database Anda:
```bash
cp .env.example .env
```
Kemudian edit file .env:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=starter
DB_USERNAME=root
DB_PASSWORD=
```

Generate Key dan Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
```

Jalankan Server
```bash
php artisan serve
```

## Usage

### Hak Akses (Role dan Permission)
Role dan permission dikelola menggunakan Spatie Role and Permission. terdiri dari :
- administrator
- user

Permission bawaan :
#### User
- List user
- create user
- edit user
- delete user
#### Role
- List role
- create role
- edit role
- delete role
#### Permission
- List permission
- create permission
- edit permission
- delete permission
#### Setting Aplikasi
- edit info app


## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Screenshot
![Screenshot_837](https://github.com/user-attachments/assets/61a3b6e3-4936-44d2-b302-25a28b9d098e)
![Screenshot_836](https://github.com/user-attachments/assets/2d740a73-cb40-4488-a724-803dc893b927)
![Screenshot_835](https://github.com/user-attachments/assets/dabb33ab-2efe-4972-b22a-9d6cf6b1e8eb)
![Screenshot_834](https://github.com/user-attachments/assets/f068bbf9-ac87-4be4-b58d-3e3cf91b1699)
![Screenshot_833](https://github.com/user-attachments/assets/36af1d5c-304e-4ea2-860c-4f6b25127a88)
