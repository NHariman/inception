# **************************************************************************** #
#                                                                              #
#                                                         ::::::::             #
#    Makefile                                           :+:    :+:             #
#                                                      +:+                     #
#    By: salbregh <salbregh@student.codam.nl>         +#+                      #
#                                                    +#+                       #
#    Created: 2021/05/19 11:42:02 by salbregh      #+#    #+#                  #
#    Updated: 2021/05/20 17:21:47 by salbregh      ########   odam.nl          #
#                                                                              #
# **************************************************************************** #

# docker-machine rm inception -y

# docker-compose [-f <arg>] [--profile <name>] [options] [COMMAND] [ARGS]
# -f specifies an alternative compose file

SRCS = ./srcs
COMPOSE = docker-compose
COMPOSE_FILE = docker-compose.yml

.ONESHELL:
SHELL := /bin/bash

up:			docker-machine-check
			bash ./srcs/requirements/tools/docker-machine-setup.sh
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} up -d

docker-machine-check:
			@brew list docker-machine || brew install docker-machine

NINGX:
			cd requirements/
			docker build -t nginx 

rebuild:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} up -d --build

stop:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} stop

restart:	stop clean up

logs:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} logs

status:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} ps

port:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} port

clean:
			${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} down -v --rmi all
			docker-machine rm inception -y

list:		
			@echo -e "\nSHOW LIST OF ALL CONTAINERS\n"
			@${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} ps
			@echo -e "\nSHOW LIST OF ALL IMAGES\n"
			@${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} images

.PHONY: 	up stop restart logs status clean list
