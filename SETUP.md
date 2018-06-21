- Install composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

1. Alterar as configurações do banco (host, username, password...)
2. Executa via terminal `setup.php` (php setup.php)

---------------------------------

sudo apt-get install apache2 -y

sudo apt-get install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update

sudo apt-get install php7.1 php7.1-fpm php7.1-cli php7.1-common php7.1-mbstring php7.1-gd php7.1-intl php7.1-xml php7.1-mysql php7.1-mcrypt php7.1-zip -y --allow-unauthenticated
sudo apt-get install libapache2-mod-php -y --allow-unauthenticated
sudo service apache2 restart
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

cd /var/www/html/
sudo chmod 777 .
git clone https://github.com/jordaos/s3-upload.git
cd s3-upload/

# AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, and AWS_SESSION_TOKEN 
