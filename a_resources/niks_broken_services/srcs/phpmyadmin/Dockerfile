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
	--no-cache \
	lighttpd \
	php7-common php7-iconv php7-json php7-gd php7-curl php7-xml php7-mysqli php7-imap php7-cgi fcgi php7-pdo php7-pdo_mysql php7-soap php7-xmlrpc php7-posix php7-mcrypt php7-gettext php7-ldap php7-ctype php7-dom php7 php7-fpm php7-opcache

COPY ./lighttpd.conf /etc/lighttpd/lighttpd.conf

RUN	apk add mysql mysql-client php-mysqli

#create a user using defaults and any specified additional info, create a user and a group named www
#also create a directory for html files
RUN adduser -D -g 'www' www && \
	mkdir /www &&\
	mkdir /run/nginx/ && \
	chown -R www:www /var/lib/nginx && \
	chown -R www:www /www 

COPY phpMyAdmin-5.0.2-all-languages.tar.gz srcs/

#unpack phpmyadmin and move it to the correct spot
RUN tar -xvzf srcs/phpMyAdmin-5.0.2-all-languages.tar.gz &&\
	mv phpMyAdmin-5.0.2-all-languages phpmyadmin &&\
	mv phpmyadmin/ www/

#setup nginx and phpmyadmin and turn on php7.3-fpm
COPY nginx.conf /etc/nginx/
COPY php.ini /etc/php/7.3/fpm/
COPY config.inc.php www/phpmyadmin

RUN	chown -R www:www /var/www/ &&\
	mkdir -p /var/lib/php/sessions && \
 	chown -R www:www /var/lib/php/sessions/ &&\
	ln -s /www/phpmyadmin/ /var/www/localhost/htdocs/phpmyadmin

#expose port 5000 for phpmyadmin
EXPOSE 5000

#restart services and use bash to create in-line command shell
#used entrypoint rather than cmd to ensure no extra arguments can be provided. 
#To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
ENTRYPOINT  nginx -g "daemon off;"
