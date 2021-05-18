# HOW TO USE DOCKERFILES.
# 1. BUILD THE IMAGE. DEFAULT:
# docker build -t wordpress .
# CHANGABLE VARIABLES WTIH --build-arg argument:
# - admin username (admin_user)
# - password (admin_pw)
# - email (admin_email)
# - autoindex on or off (autoindex)
# ADD:
# --build-arg <variable>=<your_input>
# EXAMPLE:
# docker build -t wordpress . --build-arg admin_user=nhariman --build-arg admin_pw=codam --build-arg admin_email=nhariman@student.codam.nl --build-arg autoindex=on
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
LABEL maintainer=${INTRANAME} email=<${INTRANAME}@student.codam.nl>

#install and download everything necessary
RUN apt-get update && \
	apt install -y \
	apt-utils \
	nginx \
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
	curl \
	openssl \
	sendmail

#Copy all necessary configuration files
COPY /tools/ ./tools/

#get wordpress and phpmyadmin and move them to the place where nginx makes websites
RUN tar -xvzf tools/wordpress-5.7.1.tar.gz &&\
	mv wordpress/ var/www/html/

#setup nginx and phpmyadmin and turn on php7.3-fpm
RUN	mv tools/default /etc/nginx/sites-available/ &&\
	mv tools/php.ini /etc/php/7.3/fpm/ &&\
	service php7.3-fpm start

#setup the wp-cli but don't use it yet
RUN chmod +x /tools/wp-cli.phar &&\
	mv tools/wp-cli.phar /usr/local/bin/wp &&\
	mv tools/ca-key.pem /etc/ssl/certs/ &&\
	mv tools/ca.pem /etc/ssl/certs/ &&\
	mv tools/cert.pem /etc/ssl/certs/ &&\
	mv tools/key.pem /etc/ssl/certs/

#set ownerships and generate ssl key and certificate
RUN chown -R www-data:www-data /var/www/ &&\
 	chown -R www-data:www-data /var/lib/php/sessions/ &&\
 	service php7.3-fpm restart
	
EXPOSE 9000

#restart services and execute the wordpress setup now that everything is configured with networks and whatnot using setup.sh
ENTRYPOINT  service nginx restart &&\
			service php7.3-fpm restart &&\
			service sendmail start &&\
			tools/setup.sh &&\
			bash
