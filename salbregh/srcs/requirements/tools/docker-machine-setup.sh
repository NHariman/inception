
#!/bin/bash
docker-machine create --driver virtualbox inception &&\
eval $(docker-machine env inception)