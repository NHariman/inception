CREATE USER 'wpuser'@'localhost' identified by 'dbpassword';
CREATE DATABASE wpdb;
CREATE DATABASE phpmyadmin;
GRANT ALL PRIVILEGES ON *.* TO 'wpuser'@'localhost' IDENTIFIED BY 'dbpassword';
FLUSH PRIVILEGES;