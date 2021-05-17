FROM    debian:buster
LABEL   maintainer=${INTRANAME} email=<${INTRANAME}@student.codam.nl>

RUN     apt-get update && \
        apt install -y \
        nginx
# 	wget \
# 	openssl 

# #Copy all necessary configuration files
# COPY /tools/ ./tools/

# #set ownerships and generate ssl key and certificate
# RUN mv tools/default /etc/nginx/sites-available/ &&\
# 	mv tools/index_nginx.html /var/www/html/ &&\
# 	openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/nhariman.key -out /etc/ssl/certs/nhariman.crt

# #80 for internal 433 for ssl
# #according to the nginx config in "default" the 80 port will redirect to 443 for a secure connection 
# #using the keys generated in the previous run
# EXPOSE 443

# #restart services and use bash to create in-line command shell
# #used entrypoint rather than cmd to ensure no extra arguments can be provided. 
# #To toggle the autoindex on and off use: bash srcs/autoindex_toggle.sh in shell
CMD     ["nginx", "-g", "daemon off;"]
