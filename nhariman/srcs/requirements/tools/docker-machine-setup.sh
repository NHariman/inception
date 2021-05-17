
#!/bin/bash
docker-machine create --driver virtualbox inception &&\
eval $(docker-machine env inception) &&\
cd srcs/ && docker-compose up -d