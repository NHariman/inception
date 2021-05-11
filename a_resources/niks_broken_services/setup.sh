# kubectl apply -f https://raw.githubusercontent.com/kubernetes/dashboard/v2.0.0/aio/deploy/recommended.yaml - set up kubernetes dashboard UI
# kubectl proxy //access dashboard using the kubectl command-line tool

#!/bin/bash
# install minikube
echo installing minikube
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube-darwin-amd64
install minikube-darwin-amd64 /usr/local/bin/minikube

echo installing kubectl
#
curl -LO "https://storage.googleapis.com/kubernetes-release/release/$(curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt)/bin/darwin/amd64/kubectl" && \
chmod +x ./kubectl && \
mv ./kubectl usr/local/bin/kubectl
#
echo deploy kubernetes web UI dashboard
kubectl apply -f https://raw.githubusercontent.com/kubernetes/dashboard/v2.0.0/aio/deploy/recommended.yaml
#
echo install metallb
kubectl apply -f https://raw.githubusercontent.com/metallb/metallb/v0.9.4/manifests/namespace.yaml
kubectl apply -f https://raw.githubusercontent.com/metallb/metallb/v0.9.4/manifests/metallb.yaml
	# On first install only
kubectl create secret generic -n metallb-system memberlist --from-literal=secretkey="$(openssl rand -base64 128)"
	#install config
kubectl apply -f config.yaml
#
echo build images
docker build srcs/nginx -t ft-nginx
docker build srcs/phpmyadmin -t ft-pma
docker build srcs/wordpress -t ft-wp
docker build srcs/ftps -t ft-ftps
docker build srcs/grafana -t ft-grafana

