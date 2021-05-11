# HOW TO USE DOCKERFILES.
# 1. BUILD THE IMAGE. DEFAULT:
# docker build -t ft_server .
# TO CHANGE:
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

FROM alpine
LABEL maintainer=nhariman email=<nhariman@student.codam.nl>

#install and download everything necessary, also move them to the right places
RUN apk update && \
	apk add \
	nginx \
	openssl \
	openssh \
	bash \
	openrc \
	coreutils \
	grep \
	sed \
	--no-cache

#create a user using defaults and any specified additional info, create a user and a group named www
#also create a directory for html files
RUN adduser -D -g 'www' www && \
	mkdir /www &&\
	mkdir /run/nginx/ && \
	chown -R www:www /var/lib/nginx && \
	chown -R www:www /www 

#setup nginx and phpmyadmin and turn on php7.3-fpm
COPY nginx.conf /etc/nginx/

#move standard nginx page to www to display it
RUN mv /var/lib/nginx/html/index.html www/
#set ownerships and generate ssl key and certificate
RUN	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.pem

#80 for internal 433 for ssl
#according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
#using the keys generated in the previous run
EXPOSE 80 443 22

#RUN service nginx start

#start nginx
ENTRYPOINT nginx -g "daemon off;"
