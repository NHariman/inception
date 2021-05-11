FROM alpine
LABEL maintainer=nhariman email=<nhariman@student.codam.nl>

#install and download everything necessary, also move them to the right places
RUN apk update && \
	apk add \
	nginx \
	openrc \
	coreutils \
	mysql \
	mariadb \
	mariadb-common \
	mariadb-client && \
	mkdir srcs/

COPY ./create_tables.sql srcs/

RUN mysql_install_db --user=root --datadir=/var/lib/mysql

RUN mkdir /run/mysqld && touch /run/mysqld/mysqld.sock &&\
	chmod +x /run/mysqld/mysqld.sock && \
	chown mysql:mysql -R /run/mysqld/ &&\
	ln -s /run/mysqld/mysqld.sock /tmp/mysqld.sock

EXPOSE 3306

#creates the wpdb, phpmyadmin db and mysql db. to do: update wpdb preload to contain several users and an administrator.
ENTRYPOINT mysqld --init_file /srcs/create_tables.sql --user=root