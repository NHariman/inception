# **************************************************************************** #
#                                                                              #
#                                                         ::::::::             #
#    Makefile                                           :+:    :+:             #
#                                                      +:+                     #
#    By: salbregh <salbregh@student.codam.nl>         +#+                      #
#                                                    +#+                       #
#    Created: 2021/05/19 09:38:43 by salbregh      #+#    #+#                  #
#    Updated: 2021/05/19 10:10:05 by salbregh      ########   odam.nl          #
#                                                                              #
# **************************************************************************** #

# THE MAKEFILE SHOULD SET UP THE ENTIRE APPLICATION
# IT HAS TO BUILD THE DOCKER IMAGES USING DOCKER COMPOSE

# by default make executes the first target in the file
# you can specify a default by creating a target named default which links to existing targets
# by listing multiple target you can chain their execution together

NAME = inception
DOCKER_COMPOSE = docker-compose
DOCKER_COMPOSE_FILE = docker-compose.yml
PATH = srcs

all: up

up:
	docker-machine create --driver virtualbox inception
	eval $(docker-machine env inception)
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) up -d

up_foreground:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) up

stop:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) stop

restart:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) stop
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) up -d

logs:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) logs

status:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) ps

clean:
	$(DOCKER_COMPOSE) -f $(PATH)/$(DOCKER_COMPOSE_FILE) down

.PHONY: up up_foreground stop restart logs status clean docker-machine