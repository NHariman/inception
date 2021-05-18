#if you break docker again and have to remove and reinstall it:
# rm -rf ~/Library/containers/com.docker.docker
# mkdir ~/goinfre/com.docker.docker
# ln -s ~/goinfre/com.docker.docker ~/Library/containers/com.docker.docker

#docker-machine create (name) --driver to create the VM everything will be run on

REQ = ./srcs/requirements
SRCS = ./srcs

.ONESHELL:
SHELL := /bin/bash

inception: prerequisites #nginx mariadb wordpress #dependent on the docker containers nginx, mariadb, wordpress
	# run containers with yaml
	bash ./srcs/requirements/tools/docker-machine-setup.sh ;\
	cp -r /Users/nhariman/.docker/machine/certs ${REQ}/nginx/tools ;\
	cp -r /Users/nhariman/.docker/machine/certs ${REQ}/wordpress/tools;\
	docker-compose -f ${SRCS}/docker-compose.yml up -d

prerequisites:
	@brew list docker-machine || brew install docker-machine
	mkdir -p ${HOME}/data

nginx:
	docker build -t nginx $(REQ)/nginx

mariadb:
	docker build -t mariadb $(REQ)/mariadb

wordpress: #link-network
	docker build -t wordpress $(REQ)/wordpress

stop:
	#stops containers but doesn't remove them
	docker-compose stop

down:
	#quits containers and networks but does not remove volumes
	docker-compose down

quit: #stop VM
	#shutdown containers and remove volumes
	docker-compose -f ${SRCS}/docker-compose.yml down -v
	docker-machine rm inception -y ; VBoxManage hostonlyif remove vboxnet0
	#docker network rm wordpress-network
	#if stopping won't work, use docker-machine kill inception


#if stuck on IP:
#run the following command to see which virtual boxes are around
#VBoxManage list -l hostonlyifs
#remove the offending boxes with:
#VBoxManage hostonlyif remove [name]