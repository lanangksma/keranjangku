echo "███████╗███████╗███╗   ███╗ █████╗ ███╗   ██╗ ██████╗  █████╗ ████████╗"
echo "██╔════╝██╔════╝████╗ ████║██╔══██╗████╗  ██║██╔════╝ ██╔══██╗╚══██╔══╝"
echo "███████╗█████╗  ██╔████╔██║███████║██╔██╗ ██║██║  ███╗███████║   ██║   "
echo "╚════██║██╔══╝  ██║╚██╔╝██║██╔══██║██║╚██╗██║██║   ██║██╔══██║   ██║   "
echo "███████║███████╗██║ ╚═╝ ██║██║  ██║██║ ╚████║╚██████╔╝██║  ██║   ██║   "
echo "╚══════╝╚══════╝╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝ ╚═╝  ╚═╝   ╚═╝   "

echo ">====> >====> >====> >====> >====> >====> >====> >====> >====> >====> >====>"

# git
echo "Halo apa kamu sudah melakukan git pull?"
read -r -p "Jika sudah ketik y, jika belum ketik n: " confirmation

if [ "$confirmation" == "y" ]; then
    echo "Continuing with the branch creation process..."
else
    echo "Proses pull sedang berjalan..."
    git checkout main
    git pull origin main
fi
