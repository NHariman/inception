FROM wordpress:5.7.2-fpm
# RUN rm /var/www/html/wp-config.php
# COPY conf/wp-config.php /var/www/html/

#MY CODE INSERTION:
COPY tools/wp-cli.phar /usr/local/bin/wp
RUN chmod +x /usr/local/bin/wp

RUN pwd
# sudo -u $WORDPRESS_DB_USER -i -- wp core install
# wp --allow-root core install --path=/usr/share/nginx/VelaWP.com/ --title="Vela WP" --url="https://localhost" --admin_name="limartin" --admin_email="limartin@student.codam.nl" --admin_password="limartin" 

# Below command works when executed in a running container, but not when specified in Docker file.
# Also doesn't install a theme and relies on root privileges so still needs to change. 
# Also some of the parameters might be wrong: may want to pass email through env variable, not make the Wordpress_db_user the admin, etc.
ENTRYPOINT pwd && wp --allow-root core install --url="https://limartin.42.fr" --title="limartin.42.fr" --admin_user=$WORDPRESS_DB_USER --admin_email="limartin@student.codam.nl" && \
bash

#--path=var/www/html
#######

