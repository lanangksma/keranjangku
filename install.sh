composer install
npm install
php artisan key:generate

echo "Jalankan Langkah-langkah berikut: "
echo "1. Buat 1 database dengan nama keranjangku di phpmyadmin"
echo "2. Perhatikan file .env di folder project, pada bagian Database sesuaikan dengan yang ada di local"
echo "3. Jalankan 'php artisan migrate' jika sudah menyelesaikan langkah ini"

cp .env.example .env

echo "4. Jalankan 'php artisan serve' dan 'npm run dev' untuk menjalankan project"
