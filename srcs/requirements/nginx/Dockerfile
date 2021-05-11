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
# docker run -it -p 443:443 inception
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
	wget \
	openssl 

#Copy all necessary configuration files
COPY /tools/ ./tools/

#set ownerships and generate ssl key and certificate
RUN mv tools/default /etc/nginx/sites-available/ &&\
	mv tools/new.html /var/www/html/ &&\
	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/nhariman.key -out /etc/ssl/certs/nhariman.crt

#80 for internal 433 for ssl
#according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
#using the keys generated in the previous run
EXPOSE 443

#restart services and use bash to create in-line command shell
#used entrypoint rather than cmd to ensure no extra arguments can be provided. 
#To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
ENTRYPOINT  service nginx restart &&\
			bash
