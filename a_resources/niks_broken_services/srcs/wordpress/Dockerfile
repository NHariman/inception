FROM alpine
LABEL maintainer=nhariman email=<nhariman@student.codam.nl>

#install and download everything necessary, also move them to the right places
RUN apk update && \
	apk add \
	lighttpd php7-common php7-iconv php7-json php7-gd php7-curl php7-xml php7-mysqli php7-imap php7-cgi fcgi php7-pdo php7-pdo_mysql php7-soap php7-xmlrpc php7-posix php7-mcrypt php7-gettext php7-ldap php7-ctype php7-dom \
	openrc \
	coreutils 

RUN adduser -D -g 'www' www && \
	mkdir /www &&\
	mkdir /run/nginx/ && \
	chown -R www:www /var/lib/nginx && \
	chown -R www:www /www

RUN rc-service lighttpd start && rc-update add lighttpd default && \
	apk add php5-mysql mysql mysql-client php5-zlib && \
	/etc/init.d/lighttpd restart

COPY nginx.conf /etc/nginx/

#get wordpress and phpmyadmin
RUN tar -xvzf srcs/wordpress-5.4.2.tar.gz &&\
	mv wordpress/ www/ && \
	chown -R lighttpd /www/ && \
	ln -s /www/wordpress/ /var/www/localhost/htdocs/wordpresss

#setup nginx and phpmyadmin and turn on php7.3-fpm
RUN	mv srcs/wp-config.php var/www/html/wordpress/

RUN chmod +x /srcs/wp-cli.phar &&\
	mv srcs/wp-cli.phar /usr/local/bin/wp &&\
	wp core install --url="http://localhost/wordpress"  --title="ft_services" --admin_user=wpuser --admin_password=password --admin_email=nhariman@student.codam.nl --allow-root --path="var/www/wordpress"

#set ownerships and generate ssl key and certificate
RUN chown -R www:www /var/www/ 

#80 for internal 433 for ssl
#according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
#using the keys generated in the previous run
EXPOSE 5050

ENTRYPOINT nginx -g "daemon off;"
