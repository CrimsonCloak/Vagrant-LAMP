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


readonly DATABASE_ROOT_PASSWORD="test"
readonly DATABASE_NAME="data"
readonly DATABASE_USER="php"
readonly DATABASE_PASSWORD="phptest"


# Allow for SSH 
ufw allow 22

## Install Apache
apt-get update
apt-get install -y apache2

cp "${PROVISIONING_FILES}/index.html" /var/www/html/
cp "${PROVISIONING_FILES}/info.php" /var/www/html/
cp "${PROVISIONING_FILES}/nameslist.php" /var/www/html/
cp "${PROVISIONING_FILES}/add_name.php" /var/www/html/
cp "${PROVISIONING_FILES}/styles.css" /var/www/html/
## Fix cp commands so I don't do all of them individually

ufw allow 80

## Install SQL server

apt install -y mariadb-server

## Create and configure users and database

if is_mysql_root_password_empty; then
  mysql <<_EOF_
    SET PASSWORD FOR 'root'@'localhost' = PASSWORD('${DATABASE_ROOT_PASSWORD}');
    DELETE FROM mysql.user WHERE User='';
    DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
    DROP DATABASE IF EXISTS test;
    DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
    FLUSH PRIVILEGES;
_EOF_
fi

# Create the database
  mysql --user=root --password="${DATABASE_ROOT_PASSWORD}" << _EOF_
  CREATE DATABASE IF NOT EXISTS ${DATABASE_NAME};
  GRANT ALL ON ${DATABASE_NAME}.* TO '${DATABASE_USER}'@'%' IDENTIFIED BY '${DATABASE_PASSWORD}';
  FLUSH PRIVILEGES;
  USE ${DATABASE_NAME};
  DROP TABLE IF EXISTS people;
  CREATE TABLE people (LastName varchar(255),FirstName varchar(255));
  INSERT INTO people (LastName, FirstName) VALUES ('Bond','James'), ('Torvalds', 'Linus'),('Guy','Shy');
_EOF_

## Install PHP

apt install -y php libapache2-mod-php php-mysql

## Enable firewall
ufw --force enable