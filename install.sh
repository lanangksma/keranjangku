composer install
npm install

cp .env.example .env
php artisan key:generate

echo -e "\e[31m░▀█▀░█░█░█░█░▀█▀░▀█▀░░░█░░░█▀█░█▀█░█▀▀░█░█░█▀█░█░█░░░█▀▄░█▀▀░█▀▄░▀█▀░█░█░█░█░▀█▀\e[0m"
echo -e "\e[31m░░█░░█▀▄░█░█░░█░░░█░░░░█░░░█▀█░█░█░█░█░█▀▄░█▀█░█▀█░░░█▀▄░█▀▀░█▀▄░░█░░█▀▄░█░█░░█░\e[0m"
echo -e "\e[31m░▀▀▀░▀░▀░▀▀▀░░▀░░▀▀▀░░░▀▀▀░▀░▀░▀░▀░▀▀▀░▀░▀░▀░▀░▀░▀░░░▀▀░░▀▀▀░▀░▀░▀▀▀░▀░▀░▀▀▀░░▀░\e[0m"
echo " "
echo "1. Buat 1 database dengan nama keranjangku di phpmyadmin"
echo "2. Perhatikan file .env di folder project, pada bagian Database sesuaikan dengan yang ada di local"
echo -e "3. Jalankan \e[1;37;4;44m'php artisan migrate:fresh'\e[0m jika sudah menyelesaikan langkah ini"
echo -e "4. Jalankan \e[1;37;4;44m'php artisan serve'\e[0m dan \e[1;37;4;44m'npm run dev'\e[0m di terminal yang berbeda untuk menjalankan project"
echo " "
echo "░█▀▀░█▀▀░█░░░█▀▀░█▀▀░█▀█░▀█▀"
echo "░▀▀█░█▀▀░█░░░█▀▀░▀▀█░█▀█░░█░"
echo "░▀▀▀░▀▀▀░▀▀▀░▀▀▀░▀▀▀░▀░▀░▀▀▀"
