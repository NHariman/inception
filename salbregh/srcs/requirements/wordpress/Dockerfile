FROM	wordpress

# # HOW TO USE DOCKERFILES.
# # 1. BUILD THE IMAGE. DEFAULT:
# # docker build -t wordpress .
# # CHANGABLE VARIABLES WTIH --build-arg argument:
# # - admin username (admin_user)
# # - password (admin_pw)
# # - email (admin_email)
# # - autoindex on or off (autoindex)
# # ADD:
# # --build-arg <variable>=<your_input>
# # EXAMPLE:
# # docker build -t wordpress . --build-arg admin_user=nhariman --build-arg admin_pw=codam --build-arg admin_email=nhariman@student.codam.nl --build-arg autoindex=on
# # (feel free to edit and copy the above to your liking while testing)
# # 2. RUN THE IMAGE.
# # docker run -it -p 80:80 -p 443:443 ft_server
# # 3. CHECK IF IT WORKS, GO TO:
# # 127.0.0.1 OR localhost
# # FOR WORDPRESS: localhost/wordpress ;; FOR PHPMYADMIN: localhost/phpmyadmin
# # TO CHECK AUTOINDEX: localhost/wordpress/wp-includes
# # OPTIONAL: REBUILD WITH NO-CACHE
# # docker docker build -t ft_server . --no-cache
# # TO CHECK IF ONLY ONE CONTAINER IS RUNNING:
# # docker ps

# FROM debian:buster
# LABEL maintainer=nhariman email=<nhariman@student.codam.nl>

# #install and download everything necessary
# RUN apt-get update && \
# 	apt install -y \
# 	nginx \
# 	php-cgi \
# 	php-common \
# 	php-fpm \
# 	php-pear \
# 	php-mbstring \
# 	php-zip \
# 	php-net-socket \
# 	php-gd \
# 	php-xml-util \
# 	php-gettext \
# 	php-mysql \
# 	php-bcmath \
# 	php-curl \
# 	wget \
# 	curl \
# 	openssl \
# 	sendmail

# #Copy all necessary configuration files
# COPY /tools/ ./tools/

# #get wordpress and phpmyadmin and move them to the place where nginx makes websites
# RUN tar -xvzf tools/wordpress-5.7.1.tar.gz &&\
# 	mv wordpress/ var/www/html/

# #setup nginx and phpmyadmin and turn on php7.3-fpm
# RUN	mv tools/default /etc/nginx/sites-available/ &&\
# 	mv tools/php.ini /etc/php/7.3/fpm/ &&\
# 	mv tools/wp-config.php var/www/html/wordpress/ &&\
# 	service php7.3-fpm start

# #set wp and phpmyadmin defaults, these can be changed during build by using 
# # --build-arg <arg_name>=<input>
# #default values are provided in case no arguments are given. 
# #Keep in mind, you have to use --build-arg for every variable you want to change
# ENV admin_user=user
# ENV admin_pw=pw
# ENV admin_email=user@email.com

# #setup mysql, phpmyadmin and wp database, for wp & PhpMyAdmin
# #defaults: 
# # admin_user: nhariman
# # admin_pw: codam42born2code
# RUN chmod +x /tools/wp-cli.phar &&\
# 	mv tools/wp-cli.phar /usr/local/bin/wp &&\
# 	wp core install --url="https://${INTRANAME}.42.fr/wordpress"  --title="ft_server" --admin_user=${admin_user} --admin_password=${admin_pw} --admin_email=${admin_email} --allow-root --path="var/www/html/wordpress"

# #set ownerships and generate ssl key and certificate
# RUN chown -R www-data:www-data /var/www/ &&\
#  	chown -R www-data:www-data /var/lib/php/sessions/ &&\
#  	service php7.3-fpm restart &&\
# 	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# #80 for internal 433 for ssl
# #according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
# #using the keys generated in the previous run
# EXPOSE 9000

# #restart services and use bash to create in-line command shell
# #used entrypoint rather than cmd to ensure no extra arguments can be provided. 
# #To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
# ENTRYPOINT  service nginx restart &&\
# 			service php7.3-fpm restart &&\
# 			service sendmail start &&\
# 			bash
