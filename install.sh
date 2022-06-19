#!/bin/bash
sudo cp sudoers /etc/sudoers
sudo apt update
sudo apt upgrade -y
sudo apt install php7.4 -y
sudo php install.php
sudo sh packages.sh