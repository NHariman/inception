#Base OS to start from.
FROM debian:buster

#Declare an environmental variable for auto-index, and set it to 'on' by default.
ENV AUTO_INDEX=on

#Make sure local repos have up to date package info.
RUN apt-get update
#Installing curl (rather than wget) for downloads
RUN apt-get install curl -y
#Installing unzipping software
RUN apt-get install unzip -y

#Install latest version (1.14.2) of nginx package, our web server.
RUN apt-get install nginx -y
#Copy the directory with the website's files into the container
COPY srcs/VelaWP.com /usr/share/nginx/VelaWP.com
#Copy the server config to the list of available sites
COPY srcs/server_config /etc/nginx/sites-available
#Remove the default server config from enabled sites, ours will be linked at runtime
RUN rm /etc/nginx/sites-enabled/default

#Install latest version of MariaDB server, our database/ opensource MySQL.
RUN apt-get install mariadb-server -y
#Install latest version of MariaDB client, the CLI for MariaDB.
RUN apt-get install mariadb-client -y

#Php is preinstalled with nginx, this version uses 7.3.
#Install PHP Fast Process Manager, gateway between Nginx and PHP code.
RUN apt-get install php-fpm -y
#Install MariaDB PHP extension.
RUN apt-get install php-mysql -y
#Install extension that allows php to process multi-byte char sets.
RUN apt-get install php-mbstring -y
#Install a number of other php extensions for increased functionality
RUN apt-get install php-zip php-cli php-curl php-gd php-intl php-soap php-xml php-xmlrpc -y
#Curl phpMyAdmin, our web interface for MariaDB.
RUN curl https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-all-languages.zip -o phpMyAdmin.zip
#Unzip phpMyAdmin files to a directory, and rename that directory phpMyAdmin.
RUN unzip phpMyAdmin.zip -d /usr/share
RUN mv /usr/share/phpMyAdmin-5.0.2-all-languages /usr/share/phpmyadmin
#Create sym link from phpMyAdmin dir to website root.
RUN ln -s /usr/share/phpmyadmin/ /usr/share/nginx/VelaWP.com/
#Configure phpMyAdmin with the config file in srcs.
RUN rm usr/share/phpmyadmin/config.sample.inc.php
COPY srcs/config.inc.php usr/share/phpmyadmin/config.inc.php
#Grant phpMyAdmin user their permissions and create database tables.
RUN service mysql start && \
mysql -u root mysql < usr/share/phpmyadmin/sql/create_tables.sql && \
mysql -u root --verbose --execute="GRANT ALL PRIVILEGES ON phpmyadmin.* TO root@localhost; FLUSH PRIVILEGES; UPDATE mysql.user SET plugin = 'mysql_native_password' WHERE user='root';"

#Pseudo-documentation for which ports to publish at runtime using the -p flag, which itself also exposes the ports automatically.
EXPOSE 80
EXPOSE 443

#Generating TLS (transport layer security) certificates for https traffic.
RUN mkdir etc/certs
RUN openssl req -new -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out etc/certs/MyCert.crt -keyout etc/certs/MyKey.key -subj '/C=NL/ST=Noord Holland/L=Amsterdam/O=Codam/OU=School/CN=Codam.nl'
RUN chmod 400 /etc/certs/MyKey.key

#Download WordPress with curl
RUN curl https://wordpress.org/latest.zip -o Wordpress.zip
#Unzip WordPress files to specified directory
RUN unzip Wordpress.zip -d /usr/share/nginx/VelaWP.com
#Move all of wordpress' files to the website's root directory.
RUN mv -f /usr/share/nginx/VelaWP.com/wordpress/* /usr/share/nginx/VelaWP.com

#Upload a preset configuration to Word Press, and create the correspondiing database with mysql.
COPY srcs/wp-config.php /usr/share/nginx/VelaWP.com/
RUN service mysql start && mysql -u root --verbose --execute="CREATE DATABASE wordpress_db;"

#Download the WordPress CLI as php archive file, for further wp config & install options.
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
#Make the archive file an executable
RUN chmod +x wp-cli.phar
#Rename the executable 'wp' and move it to the /bin directory.
RUN mv wp-cli.phar /usr/local/bin/wp

#Installing sendmail here, otherwise the wp CLI complains about the next step during image building.
RUN apt-get install sendmail -y

#Install WordPress: Set the name, url and admin.
RUN service mysql start && wp core install --allow-root --path=/usr/share/nginx/VelaWP.com/ --title="Vela WP" --url="https://localhost" --admin_name="limartin" --admin_email="limartin@student.codam.nl" --admin_password="limartin" 

#Set a nice wp theme (which obviously has to be boats), but its also a really buggy old theme so we turn DEBUG off.
#RUN service mysql start && wp theme install ships-ahoy --allow-root --path=/usr/share/nginx/VelaWP.com/ --activate && \
#sed -i "s/'WP_DEBUG', true/'WP_DEBUG', false/g" /usr/share/nginx/VelaWP.com/wp-config.php

#This is the shell script we can run with docker exec to change auto index on a running container
COPY srcs/auto.sh /
RUN	chmod +x auto.sh

#Change max file and post size
RUN	sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 20M/' /etc/php/7.3/fpm/php.ini
RUN	sed -i 's/post_max_size = 8M/ post_max_size = 21M/' /etc/php/7.3/fpm/php.ini

#Change the permissions of the default nginx user
RUN chown -R www-data:www-data /usr/share/
RUN chmod 755 -R /usr/share/

#Final entrypoint command upon running the docker container:
ENTRYPOINT service php7.3-fpm start && \
service nginx start && \
ln -s /etc/nginx/sites-available/server_config /etc/nginx/sites-enabled/server_config && \
sed -i "s/autoindex .*;/autoindex $AUTO_INDEX;/" /etc/nginx/sites-available/server_config && \
cp /etc/hosts /etc/hosts.new && \
sed -i '1 a 127.0.0.1	localhost	velawp.com' /etc/hosts.new && \
echo "$(cat /etc/hosts.new)" > /etc/hosts && \
service nginx restart && \
service mysql start && \
service sendmail start && \
bash

#COMMAND FOR SETTING UP DOCKER IN GOINFRE DIRECTORY ON CODAM IMACS:
#mkdir -p ~/goinfre/docker && rm -rf ~/Library/Containers/com.docker.docker && ln -s ~/goinfre/docker ~/Library/Containers/com.docker.docker && cd ~/goinfre && ls

#COMMAND FOR BUILDING THE IMAGE:
#docker build -t IMAGE_NAME .

#COMMAND FOR RUNNING CONTAINER:
#docker run -it -p 80:80 -p 443:443 --add-host=velawp.com:127.0.0.1 --env AUTO_INDEX=on/off --name=CONTAINER_NAME IMAGE_NAME

#COMMAND FOR UPDATING AUTO INDEX:
#docker exec -it --env AUTO_INDEX=on/off CONTAINER_NAME ./auto.sh
