#!/usr/bin/env bash

# More strict Bash mode
set -o errexit   # abort on nonzero exitstatus
set -o nounset   # abort on unbound variable
set -o pipefail  # don't mask errors in piped commands


# Set some variables 
# Location of provisioning scripts and files
readonly PROVISIONING_SCRIPTS="/vagrant/provisioning"
# Location of files to be copied to this server
readonly PROVISIONING_FILES="${PROVISIONING_SCRIPTS}/files"

# Allow for SSH 
ufw allow 22

## Install Apache
apt-get update
apt-get install -y apache2

cp "${PROVISIONING_FILES}/index.html" /var/www/html/
cp "${PROVISIONING_FILES}/info.php" /var/www/html/



ufw allow 80

## Install SQL server

apt install -y mysql-server

## Installation script

# no -> password validation
# y -> remove anonymous users
# y -> disallow root login remotely
# y -> remove test database
# y -> reload privilige tables

## Install PHP

apt install -y php libapache2-mod-php php-mysql

## Enable firewall
ufw --force enable