# start by defining a name for you target
# the target is a collection of commands that need to be performed
# to complete an action, like building an image

# by default make executes the first target in the file
# you can specify a default by creating a target named default which links to existing targets
# by listing multiple target you can chain their execution together

NAME = inception

default: build

build:
	docker build -t $(NAME) .

debug:
	docker run --rm $(NAME) /bin/bash

run:
	docker run --rm $(NAME)