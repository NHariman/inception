# **************************************************************************** #
#                                                                              #
#                                                         ::::::::             #
#    Makefile                                           :+:    :+:             #
#                                                      +:+                     #
#    By: salbregh <salbregh@student.codam.nl>         +#+                      #
#                                                    +#+                       #
#    Created: 2021/05/19 11:42:02 by salbregh      #+#    #+#                  #
#    Updated: 2021/05/19 12:23:29 by salbregh      ########   odam.nl          #
#                                                                              #
# **************************************************************************** #

# docker-machine rm inception -y

SRCS = ./srcs
COMPOSE= docker-compose
COMPOSE_FILE= docker-compose.yml

.ONESHELL:
SHELL := /bin/bash

up: docker-machine-check
	bash ./srcs/requirements/tools/docker-machine-setup.sh
	# ${COMPOSE} -f ${SRCS}/${COMPOSE_FILE} up -d
	docker-compose -f ${SRCS}/docker-compose.yml up -d

docker-machine-check:
	@brew list docker-machine || brew install docker-machine

