#docker-machine create (name) --driver to create the VM everything will be run on

inception: #dependent on the docker containers nginx, mariadb, wordpress
	#start VM with docker-machine
	docker-machine create --driver virtualbox inception
	# run containers with yaml
	cd srcs/ &&	docker-compose up

#make docker images by compiling them with docker build && docker run?

stop: #stop VM
	#shutdown containers
	#remove containers
	docker-machine stop inception