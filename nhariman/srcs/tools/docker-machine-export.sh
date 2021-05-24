#!/bin/bash
export DOCKER_TLS_VERIFY="1"
export DOCKER_HOST="tcp://192.168.99.161:2376"
export DOCKER_CERT_PATH="/Users/nhariman/.docker/machine/machines/inception"
export DOCKER_MACHINE_NAME="inception"
# Run this command to configure your shell: 
# eval $(docker-machine env inception)
