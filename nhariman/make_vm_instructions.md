# How to create a virtual machine

For inception, if you don't have a virtual machine yet, you can install a basic one by running these commands.

Start by using this command to create the VM, call it Inception and give it OS type debian 64bits. Next you use the --register flag to register your VM with the oracle VM virtualbox installation.
Lastly you can specify the basefolder (use current directory).
You can also add the --default flag to install the default configureation of the specified guest OS. By default, the VM is ccreated with minimal hardware.
```
VBoxManage createvm --name inception --ostype debian_64 --register --basefolder .
```

making the encrypted partitions using LVM:
LVM stands for Logical Volume partitioning.
It is a device mapper target that provides logical volume management for Linux kernels. 
more info can be found here: https://terminalblues.dev/LVM-Lab-Setup-With-VirtualBox

First you will need to create a virtual disk (vdisk) and attach it to the VM
To create the disk:
```
VboxManage createhd --filename disk.vmdk --size [in MB] --format VMDK
```
To attach it:
```
VboxManage storageattach [name of vm] --storagectl "SATA" --port 1 --device 0 --type hdd --medium [disk location]/vdisk.vmdk
```


