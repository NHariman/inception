#if you break docker again and have to remove and reinstall it:
# rm -rf ~/Library/containers/com.docker.docker
# mkdir ~/goinfre/com.docker.docker
# ln -s ~/goinfre/com.docker.docker ~/Library/containers/com.docker.docker

#docker-machine create (name) --driver to create the VM everything will be run on

ifneq (,$(findstring xterm,${TERM}))
	BLACK        := $(shell tput -Txterm setaf 0)
	RED          := $(shell tput -Txterm setaf 1)
	GREEN        := $(shell tput -Txterm setaf 2)
	YELLOW       := $(shell tput -Txterm setaf 3)
	LIGHTPURPLE  := $(shell tput -Txterm setaf 4)
	PURPLE       := $(shell tput -Txterm setaf 5)
	BLUE         := $(shell tput -Txterm setaf 6)
	WHITE        := $(shell tput -Txterm setaf 7)
	RESET := $(shell tput -Txterm sgr0)
else
	BLACK        := ""
	RED          := ""
	GREEN        := ""
	YELLOW       := ""
	LIGHTPURPLE  := ""
	PURPLE       := ""
	BLUE         := ""
	WHITE        := ""
	RESET        := ""
endif

REQ = ./srcs/requirements
SRCS = ./srcs

.ONESHELL:
SHELL := /bin/bash

#bash ./srcs/requirements/tools/docker-machine-setup.sh put back
inception: prerequisites #nginx mariadb wordpress #dependent on the docker containers nginx, mariadb, wordpress
	@# run containers with yaml
	@echo "${RED}Creating Inception VM.${RESET}" &&\
	docker-machine create --driver virtualbox inception
	@echo "${GREEN}Inception VM created.${RESET}"
	@echo "${RED}Setting environment to VM${RESET}"
	@echo "#!/bin/bash" > docker-machine-export.sh
	docker-machine env inception >> ${SRCS}/tools/docker-machine-export.sh &&\
	eval bash ${SRCS}/tools/docker-machine-export.sh &&\
	cp -r /Users/nhariman/.docker/machine/certs ${REQ}/nginx/tools ;\
	cp -r /Users/nhariman/.docker/machine/certs ${REQ}/wordpress/tools
	@echo "${RED}Running Docker-compose${RESET}" &&\
	docker-compose -f ${SRCS}/docker-compose.yml up -d

prerequisites:
	@echo "${BLUE}Running prerequisites. Checking if docker-machine is installed${RESET}"
	@brew list docker-machine || brew install docker-machine
	@mkdir -p ${HOME}/data
	@echo "${GREEN}Created ${HOME}/data folder${RESET}"

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