echo "SEMANGAT KAWAN!!!"
echo "-----------------"

# git
git pull

echo "Kamu lagi kerjain fitur apa?"
read cabang
git branch "$cabang"
git checkout "$cabang"
echo "Semangat kerjain fitur $cabang nya!"
