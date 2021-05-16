# /bin/bash

wp core install --url="https://${DOMAIN_NAME}/wordpress"  --title="Inception" --admin_user=${WP_ADMIN} --admin_password=${WP_ADMIN_PW} --admin_email=${WP_ADMIN_EMAIL} --allow-root --path="var/www/html/wordpress" &&\
wp user create ${USR} ${USR}@42.fr --user_pass=#{USR_PW} --porcelain