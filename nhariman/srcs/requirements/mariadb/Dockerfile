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
RUN apt-get update &&\
	apt install -y \
	apt-utils \
	mariadb-server \
	mariadb-client

#Copy all necessary configuration files
COPY /tools/ ./tools

RUN service mysql start &&\
	mysql -e "CREATE USER '${SQL_ADMIN}'@'localhost' identified by '${SQL_ADMIN_PW}';" &&\
	mysql -e "CREATE DATABASE wpdb;" &&\
	mysql -e "GRANT ALL PRIVILEGES ON *.* TO '${SQL_ADMIN}'@'localhost' IDENTIFIED BY '${SQL_ADMIN_PW}';" &&\
	mysql -e "FLUSH PRIVILEGES;"

EXPOSE 3306

ENTRYPOINT  service mysql restart
