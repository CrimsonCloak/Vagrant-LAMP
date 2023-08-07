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


apt-get update
apt-get install -y apache2

cp "${PROVISIONING_FILES}/index.html" /var/www/html/

ufw allow 22
ufw allow 80
ufw --force enable