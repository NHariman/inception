#if you break docker again and have to remove and reinstall it:
# rm -rf ~/Library/containers/com.docker.docker
# mkdir ~/goinfre/com.docker.docker
# ln -s ~/goinfre/com.docker.docker ~/Library/containers/com.docker.docker

#docker-machine create (name) --driver to create the VM everything will be run on

SRCS = ./srcs/requirements

inception: prerequisites network-start #nginx mariadb wordpress #dependent on the docker containers nginx, mariadb, wordpress
	# run containers with yaml
	eval $(docker-machine env inception) &&\
	cd srcs/ &&	docker-compose up -d

prerequisites:
	@brew list docker-machine || brew install docker-machine

network-start: 
	#start VM with docker-machine
	docker-machine create --driver virtualbox inception ;\
	docker-machine env inception ;\
	eval $(docker-machine env inception)

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

stop:
	#stops containers but doesn't remove them
	docker-compose stop

down:
	#quits containers and networks but does not remove volumes
	docker-compose down

quit: #stop VM
	#shutdown containers and remove volumes
	cd srcs/ && docker-compose down -v
	docker-machine stop inception ; docker-machine rm inception -y ; VBoxManage hostonlyif remove vboxnet0
	#docker network rm wordpress-network
	#if stopping won't work, use docker-machine kill inception


#if stuck on IP:
#run the following command to see which virtual boxes are around
#VBoxManage list -l hostonlyifs
#remove the offending boxes with:
#VBoxManage hostonlyif remove [name]