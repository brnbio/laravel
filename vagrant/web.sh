#!/usr/bin/env bash

PHP_VERSION=$1

# setup host
sudo rm /etc/nginx/sites-enabled/default
sudo rm /etc/nginx/sites-available/default
echo "server {
	listen 80;
	listen [::]:80;
	root /var/www/html/public/;
	index index.php;
	location / {
		try_files \$uri \$uri/ /index.php?\$args;
	}
	location ~ \.php\$ {
		try_files \$uri =404;
		include /etc/nginx/fastcgi_params;
		fastcgi_pass   unix:/run/php/php$PHP_VERSION-fpm.sock;
		fastcgi_index  index.php;
		fastcgi_param  SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
	}
}" | sudo tee /etc/nginx/sites-available/default
sudo ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default
sudo service nginx restart

# php version
sudo update-alternatives --set php /usr/bin/php$PHP_VERSION
sudo update-alternatives --set phar /usr/bin/phar$PHP_VERSION
sudo update-alternatives --set phar.phar /usr/bin/phar.phar$PHP_VERSION

# aliases
echo "alias h=\"cd ~\"" >> /home/vagrant/.bash_aliases
echo "alias www=\"cd /var/www/html\"" >> /home/vagrant/.bash_aliases
echo "alias g=\"git\"" >> /home/vagrant/.bash_aliases
echo "alias gs=\"git status\"" >> /home/vagrant/.bash_aliases
echo "alias pa=\"php artisan\"" >> /home/vagrant/.bash_aliases