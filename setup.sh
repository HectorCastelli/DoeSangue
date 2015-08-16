#!/bin/bash
sudo systemctl start httpd mysqld
compass watch Website
sudo systemctl stop httpd mysqld