FROM alpine

RUN apk add vsftpd \
	openrc &&\
	rc-update add vsftpd default 

RUN mkdir /srv/ftp && chown nobody:nogroup /srv/ftp

COPY vsftpd.conf /etc/vsftpd/
COPY anon.txt /srv/ftp/

EXPOSE 21

ENTRYPOINT service vsftpd restart
