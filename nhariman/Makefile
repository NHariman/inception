#docker-machine create (name) --driver to create the VM everything will be run on

SRCS = ./srcs/requirements

inception: prerequisites network-start #nginx mariadb wordpress #dependent on the docker containers nginx, mariadb, wordpress
	# run containers with yaml
	cd srcs/ &&	docker-compose up -d

prerequisites:
	@brew list docker-machine || brew install docker-machine

network-start: 
	#start VM with docker-machine
	docker-machine create --driver virtualbox inception
	docker-machine env inception
	eval $(docker-machine env inceptionn)

nginx:
	docker build -t nginx $(SRCS)/nginx

mariadb:
	docker build -t mariadb $(SRCS)/mariadb

# link-network:
# 	docker network create --attachable wordpress-network
# 	docker network connect wordpress-network mariadb
# 	docker network connect wordpress-network wordpress
# 	docker network connect wordpress-network nginx


wordpress: #link-network
	docker build -t wordpress $(SRCS)/wordpress

#make docker images by compiling them with docker build && docker run?

quit: #stop VM
	#shutdown containers
	#remove containers
	docker-machine stop inception
	docker-machine rm inception -y
	#docker network rm wordpress-network


#if stuck on IP:
#run the following command to see which virtual boxes are around
#VBoxManage list -l hostonlyifs
#remove the offending boxes with:
#VBoxManage hostonlyif remove [name]