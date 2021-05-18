mkdir -p ~/goinfre/docker
rm -rf ~/Library/Containers/com.docker.docker
ln -s ~/goinfre/docker ~/Library/Containers/com.docker.docker

#stop all running containers:
docker stop $(docker ps -aq)

#remove all containers
docker rm $(docker ps -aq)

#remove all images:
docker rmi $(docker images -q)