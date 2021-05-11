mkdir /run/mysqld/
mysql_install_db --user=root --datadir=/var/lib/mysql
touch /run/mysqld/mysqld.sock
chmod +x mysqld.sock
chown mysql:mysql -R /run/mysqld/
cd /tmp
ln -s /var/run/sqld/mysqld.sock mysqld.sock
