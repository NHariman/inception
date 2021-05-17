NAME = inception
YML_PATH = srcs

all: $(NAME)

# Run docker-compose.yml
$(NAME):
	docker-compose -f $(YML_PATH)/docker-compose.yml up -d

overv:
	ls -la && docker ps -a && docker image ls

# Stops and removes all containers
clean:
	docker stop $$(docker ps -aq)
	docker rm $$(docker ps -aq)

# Also removes all images, as well as performing clean
fclean: clean
	docker rmi $$(docker images -q)

re: fclean all

.PHONY: all overv clean fclean re