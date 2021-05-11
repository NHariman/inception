**the components of a YAML file**
Service: directs traffic to a pod

TargetPort: the port on which your application is running inside the container.

Port: if your application serves different services on a different port, that is indicated here.

ClusterIP: only accesssible while inside the cluster from the spec.clusterIP port.if a spec.ports[*].targetPort is set, it will route from the port to the target port.

LoadBalancer: exposes LoadBalancerIp, NodeIP and clusterIP. This service is accessible from the loadbalancer's IP address, which routes your request to a nodePort, which routes to the clusterIP port. It can be accessed like a nodeport AND a clusterIP port.

ContainerPort: defines the port on which the app can be reached outside the container. MUST be identical to targetport, most of the time.

**the basics of a YAML file for kubernetes**
source: https://www.youtube.com/watch?v=qmDzcu5uY1I&list=PLy7NrYWoggjziYQIDorlXjTvvwweTYoNC&index=7

Every configuration file in kubernetes has 3 parts:
- where the metadata is stored (name)
- specification: configuration for the components.
- status, this is automatically generated and added by kubernetes.

deployment and service will have its own configurations

yaml file is usually stored in the config file with your application code. but it can also be put on git.

pod blueprint:
in the spec: part of the deployment file the template is found. it's like a config file inside a config file.

Connecting components:
labels and selectors are used, the meta data contains the labels, spec part contains selectors.
label is matched to selector.

in Service: a selector is defined that talks wtih the label in deployment. ie.
label:
	app: nginx
connects with:
selector:
	app: nginx

targetport and containerport should also match.

to run yaml files:
kubectl apply -f deployment.yaml

to check which pods are running:
kubectl get pod

check services:
kubectl get service

check what service is running:
kubectl describe service [name of service]

how to know the correct pod addresses:
kubectl get pod -o (output) wide (more info)

check status:
kubectl get deployment [deployment name] -o yaml

to remove deployment:
kubectl delete -f [yaml file name]

**An Introduction to Kubernetes**
Source: https://www.youtube.com/watch?v=VnvRFRk_51k

What is Kubernetes:
an open source container orchestrated tool that can manage docker and other types of containers. it helps you manage applications that are made up of hundreds of containerized applications and helps you manage them in different environemnts ranging from physical, virtual or cloud.

This is especially useful for microapplications and microservices, managing them all from one tool instead of across multiple to streamline the process.
This results in high availability (little downtime), scalability (fast loading, high response rate for applications) and better disaster recovery (better way to backup and restore it in case of an emergency and the application doesn't break completely).

**the basic architecture:
the cluster exists of at least 1 master node, connected to worker nodes. where each node has a kublet process, this allowes contact between processes. each node contains docker containers on which the appliations are running.

on the master node the processes that make the node processes functional are run.
Among them are:
- the API server, which serves as an entry point to the kubernetes cluster, like a UI (the Kubernetes web dashboard which is required in the subject), an API or a CLI (commandline functions, such as minikube.)
- controller manager, keeps an overview over what's happening in the cluster ie. restarting clusters etc.
- scheduler, ensures pod placement, schedule containers on nodes based on what's available and the load.
- etcd, contains the kubernetes cluster backup.

between the master and the nodes is the virtual network, which turn sthe nodes into one powerful machine that has the sum of all the individual nodes to create a unified machine.

loss of the master node access will prevent you from accessing the rest of the cluster, therefore it is usually the case to have two or more master nodes.

***pods and containers

a pod is the smallest unit that you as a user will configure and interact with. it is a repo of a container. on each worker node there will be multiple nodes and ontaining multiple container. Usually one pod has one application, but in the event of a pod containing a process that requires multiple dockerfiles to function, you can have multiple containers in one pod.

each pod is assigned its own ip address, so its own server. and these IP addresses are used between pods for communication within the virtual network. However, if a pod dies, a new IP address is created, which is inconvenient for management. therefore kubernetes utilises Service, which is a IP address like tag on the pod and will not disappear if a pod disappears.
Service has two main functions:
- give each pod a permenant IP address to communcate between pods
- load balancer

*** the basic configuration of a kubernetes cluster:
all the configuration for kubernetes goes through API server, so a web UI, an API or a comandline tool. They interface with the cluster using a JSON or YAML script.
the YAML configures the deployment for the master cluster, and serves as a template for creating pods.

an example of a YAML file:
this YAML file creates two replica pods (1) called my-app, with container (2) based on my-image (3). it also sets up the environment variables (4) and which ports it listens to (5)
```
apiVersion: apps/v1
kind: deployment
metadata:
	name: my-app
	labels:
		app: my-app
spec:
	replicas: 2 <---- (1)
	selector:
		matchLabels:
			app: my-app
	template:
		metadata:
			labels:
				app: my-app
		spec:
			containers:           <--- (2)
				- name: my-app
				  image: my-image <--- (3)
				  env:           <------(4)
				   - name: SOME_ENV
				     value: $SOME_ENV
				  ports:         <----- (5)
				  	- containerPort:8080
```

****Basic Kubernetes architecture****

*about worker nodes:
example: one node with two application pods running on it.
each node has multiple pods on it and contain 3 processes that MUST be installed on each node in order to use and manage the pods.
- container runtime (Docker)
- kubelet (shecduler, intereacts wtih both the container and the node.). Kubelet starts the pod with a container inside.
- Kube Proxy, worker nodes contain applications and databases in pods. Usually, a cluster contains multiple nodes, which will all communicate with each other via Services. Services is a load balancer that catches communcation between pods and forwards it to the respective pods. in order to ensure that this communcation works, kube proxy is used.

*about master nodes:
Master nodes are structured completely differently from worker nodes.
There are 4 processes that run on every master node that control cluster state and the worker nodes.
- API server, if a user wishes to deploy a new application that is done through here. it is a cluster Gateway which gets the initial requests of updates or even querys from the cluster. it is also a gatekeeper for authentication.
- scheduler, starts the application pods in one of the worker nodes and decides on which worker node the pod will be scheduled.
- controller manager. when pods die on any node there must be a way to reschedule those pods asap. the controller manager checks for cluster changes such as changes in pod amounts and tries to recover the cluster state asap. it does this by sending requests to the scheduler.
- etcd, a key value store of a cluster state. it is the cluster's brain which means every change in the cluster are saved or updated into the key value store. it also serves as backup. APPLICATION data is NOT stored in the etcd, only cluster and other master process related stuff

**example of a cluster setup:
in a small cluster there are usually two master nodes, and three worker nodes.
master nodes have less load and use less resources whereas worker nodes have bigger loads and use more resources due to them having more processes.
kubernetes allows you to install new master and worker nodes while it's operational by performing basic setups.

**basic components of kubernetes.
source:  https://www.youtube.com/watch?v=umXEmn3cMWY

pod:
	- abstraction over container. pod creates a layer over the container to take away the runtime container in case you want to replace it. so you can avoid docker if you want.
each pod is meant to contain one application. so for example, a node with an application and a database contains two pods.

each pod has its own IP address and it can communicate with other pods using said IP addresss (also called a Service)

Service:
a permanent IP address that is attached to each pod. the life cycle of a pod and service is not contected so even if a pod dies the service address does not change. also helps with load balancing.

external services:
access application via web, external services opens the communcation from external sources.
for databases, internal services are used, this is specified by you.

Ingress: can come before service which makes the url pretty.

Configmap:
external configuration to your application. contains config data like urls. by connecting this to the pod variable names are easily changed.
Secret:
like configmap but used to store credentials and secret data and stored in based64 encoded format.

Volumes:
attaches a physical storage on a harddrive to the pod. this can be done local (on the server node) or remote (outside the kubernetes cluster)

Deployment:
blueprint for my-app pods. can be used to scale up or scale down your application if needed. it is an abstraction of pods and makes it easier to interact with them. in practice mostly deployment will be worked with.
databases cannot be replicated using deployment! for that you need to use StatefulSet.

StatefulSet:
keeps databases synchronised.

However, StatefulSet is tedious and difficult, therefore in some practices, the database will be hosted Outside the kubernetes cluster.