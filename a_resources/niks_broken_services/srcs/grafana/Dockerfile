FROM alpine
#https://grafana.com/docs/grafana/latest/administration/configuration/
RUN apk add wget bash openrc coreutils &&\
	wget https://dl.grafana.com/oss/release/grafana-7.3.0.linux-amd64.tar.gz &&\
	tar -zxvf grafana-7.3.0.linux-amd64.tar.gz

RUN mv grafana-7.3.0 /etc/grafana &&\
	rm grafana-7.3.0.linux-amd64.tar.gz

EXPOSE 3000

ENTRYPOINT bash