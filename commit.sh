#!/bin/bash
#########################################################
echo -e "\e[1;37;4;44mTuliskan Nama Branch Kamu\e[0m"
read -r cabang

# Check if branch already exists
if git rev-parse --verify "$cabang" >/dev/null 2>&1; then
    echo "Branch $cabang already exists. Checking it out..."
    git checkout "$cabang"
else
    git branch "$cabang"
    git checkout "$cabang"
    echo "Semangat kerjain fitur $cabang nya!"
fi

echo "Pastikan semua file sudah di-add. Lanjutkan commit? (y/n)"
read -r jawaban

if [ "$jawaban" == "y" ]; then
    git add .

    echo "Tuliskan pesan commitnya, contoh: (Feat: Menambahkan fitur login)"
    read -r pesan_commit
    current_time=$(date "+%Y-%m-%d %H:%M:%S")

    git commit -m "$pesan_commit, Pada : $current_time"
    git push origin "$cabang"
    echo "Semangat! commit berhasil."
else
    echo "Jangan lupa untuk menambahkan file yang diubah."
    exit 0
fi
