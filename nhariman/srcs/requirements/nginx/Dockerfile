# HOW TO USE DOCKERFILES.
# 1. BUILD THE IMAGE. DEFAULT:
# docker build -t inception .

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
LABEL maintainer=${INTRANAME} email=<${INTRANAME}@student.codam.nl>

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
	mv tools/index_nginx.html /var/www/html/

#80 for internal 433 for ssl
#according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
#using the keys generated in the previous run
EXPOSE 443

#restart services and use bash to create in-line command shell
#used entrypoint rather than cmd to ensure no extra arguments can be provided. 
#To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
STOPSIGNAL SIGQUIT

ENTRYPOINT  nginx -g daemon off;
