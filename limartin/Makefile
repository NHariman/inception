NAME = inception
YML_PATH = srcs

all: $(NAME)

# Run docker-compose.yml
$(NAME):
	docker-compose -f $(YML_PATH)/docker-compose.yml up -d

overv:
	@echo "FILES" && ls -la && echo "" && docker ps -a && echo "" && docker image ls

# Stops all running containers
stop:
	@docker stop $$(docker ps -aq) 2> /dev/null || echo "There are no containers to stop"

# Removes all containers
clean: stop
	@docker rm $$(docker ps -aq) 2> /dev/null || echo "There are no containers to remove"

# Also removes all images, as well as performing clean
fclean: clean
	@docker rmi -f $$(docker images -q) 2> /dev/null || echo "There are no images to remove"
	@docker-compose -f srcs/docker-compose.yml down -v --remove-orphans  2> /dev/null

re: fclean all

.PHONY: all overv stop clean fclean re