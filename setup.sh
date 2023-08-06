#!/usr/bin/env bash
apt-get update
apt-get install -y apache2
ufw allow 22
ufw allow 80
ufw --force enable