# Using Dockerhub image to test stuff - this needs to be changed
FROM nginx

#Copy the directory with the website's files into the container
COPY ./limartin.42.ForReal /usr/share/nginx/limartin.42.fr
#Copy the server config to the list of available sites
COPY ./conf/server_config /etc/nginx/sites-available

#Remove the default server config from enabled sites, ours will be linked at runtime
# RUN rm /etc/nginx/sites-enabled/default

# RUN mkdir etc/certs
# RUN openssl req -new -newkey rsa:4096 -x509 -sha256 -days 365 -nodes -out etc/certs/MyCert.crt -keyout etc/certs/MyKey.key -subj '/C=NL/ST=Noord Holland/L=Amsterdam/O=Codam/OU=School/CN=Codam.nl'
# RUN chmod 400 /etc/certs/MyKey.key

# RUN service nginx start