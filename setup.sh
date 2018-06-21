sudo apt-get install apache2 -y

sudo apt-get install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update

sudo apt-get install php php-fpm php-cli php-common php-mbstring php-gd php-intl php-xml php-mysql php-mcrypt php-zip -y --allow-unauthenticated
sudo apt-get install libapache2-mod-php -y --allow-unauthenticated
sudo service apache2 restart
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
composer install