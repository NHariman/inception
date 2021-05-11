# HOW TO USE DOCKERFILES.
# 1. BUILD THE IMAGE. DEFAULT:
# docker build -t ft_server .
# CHANGABLE VARIABLES WTIH --build-arg argument:
# - admin username (admin_user)
# - password (admin_pw)
# - email (admin_email)
# - autoindex on or off (autoindex)
# ADD:
# --build-arg <variable>=<your_input>
# EXAMPLE:
# docker build -t ft_server . --build-arg admin_user=nhariman --build-arg admin_pw=codam --build-arg admin_email=nhariman@student.codam.nl --build-arg autoindex=on
# (feel free to edit and copy the above to your liking while testing)
# 2. RUN THE IMAGE.
# docker run -it -p 80:80 -p 443:443 ft_server
# 3. CHECK IF IT WORKS, GO TO:
# 127.0.0.1 OR localhost
# FOR WORDPRESS: localhost/wordpress ;; FOR PHPMYADMIN: localhost/phpmyadmin
# TO CHECK AUTOINDEX: localhost/wordpress/wp-includes
# OPTIONAL: REBUILD WITH NO-CACHE
# docker docker build -t ft_server . --no-cache
# TO CHECK IF ONLY ONE CONTAINER IS RUNNING:
# docker ps

FROM debian:buster
LABEL maintainer=nhariman email=<nhariman@student.codam.nl>

#install and download everything necessary
RUN apt-get update && \
	apt install -y \
	nginx \
	mariadb-server \
	mariadb-client \
	php-cgi \
	php-common \
	php-fpm \
	php-pear \
	php-mbstring \
	php-zip \
	php-net-socket \
	php-gd \
	php-xml-util \
	php-gettext \
	php-mysql \
	php-bcmath \
	php-curl \
	wget \
	openssl \
	sendmail

#Copy all necessary configuration files
COPY /srcs/ ./srcs/

#get wordpress and phpmyadmin and move them to the place where nginx makes websites
RUN tar -xvzf srcs/wordpress-5.4.2.tar.gz &&\
	mv wordpress/ var/www/html/ &&\
	tar -xvzf srcs/phpMyAdmin-5.0.2-all-languages.tar.gz &&\
	mv phpMyAdmin-5.0.2-all-languages phpmyadmin &&\
	mv phpmyadmin/ var/www/html/

#setup nginx and phpmyadmin and turn on php7.3-fpm
RUN	mv srcs/default /etc/nginx/sites-available/ &&\
	mv srcs/php.ini /etc/php/7.3/fpm/ &&\
	mv srcs/wp-config.php var/www/html/wordpress/ &&\
	mv srcs/config.inc.php var/www/html/phpmyadmin &&\
	service php7.3-fpm start

#set wp and phpmyadmin defaults, these can be changed during build by using 
# --build-arg <arg_name>=<input>
#default values are provided in case no arguments are given. 
#Keep in mind, you have to use --build-arg for every variable you want to change
ARG admin_user=user
ARG admin_pw=pw
ARG admin_email=user@email.com

#setup mysql, phpmyadmin and wp database, for wp & PhpMyAdmin
#defaults: 
# admin_user: nhariman
# admin_pw: codam42born2code
RUN service mysql start &&\
	mysql -e "CREATE USER '${admin_user}'@'localhost' identified by '${admin_pw}';" &&\
	mysql -e "CREATE DATABASE wpdb;" &&\
	mysql -e "CREATE DATABASE phpmyadmin;" &&\
	mysql -e "GRANT ALL PRIVILEGES ON *.* TO '${admin_user}'@'localhost' IDENTIFIED BY '${admin_pw}';" &&\
	mysql -e "FLUSH PRIVILEGES;"&&\
	mysql phpmyadmin < var/www/html/phpmyadmin/sql/create_tables.sql &&\
	sed -i "s/wpuser/${admin_user}/g" var/www/html/wordpress/wp-config.php &&\
	sed -i "s/dbpassword/${admin_pw}/g" var/www/html/wordpress/wp-config.php &&\
	sed -i "s/wpuser/${admin_user}/g" var/www/html/phpmyadmin/config.inc.php &&\
	sed -i "s/dbpassword/${admin_pw}/g" var/www/html/phpmyadmin/config.inc.php &&\
	chmod +x /srcs/wp-cli.phar &&\
	mv srcs/wp-cli.phar /usr/local/bin/wp &&\
	wp core install --url="https://localhost/wordpress"  --title="ft_server" --admin_user=${admin_user} --admin_password=${admin_pw} --admin_email=${admin_email} --allow-root --path="var/www/html/wordpress"

#set ownerships and generate ssl key and certificate
RUN chown -R www-data:www-data /var/www/ &&\
 	chown -R www-data:www-data /var/lib/php/sessions/ &&\
 	service php7.3-fpm restart &&\
	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

#set autoindex on or off during build
#this setting can be changed within the container at will too.
#By default it is on.
ARG autoindex=on

RUN sed -i "26s/autoindex.*/autoindex ${autoindex};/g" /etc/nginx/sites-available/default

#80 for internal 433 for ssl
#according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
#using the keys generated in the previous run
EXPOSE 80 443

#restart services and use bash to create in-line command shell
#used entrypoint rather than cmd to ensure no extra arguments can be provided. 
#To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
ENTRYPOINT  service nginx restart &&\
			service mysql restart &&\
			service php7.3-fpm restart &&\
			service sendmail start &&\
			bash
