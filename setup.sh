#!/bin/sh

DATABASE_NAME=webshop
DATABASE_USER=root

../bin/mysql -u "${DATABASE_USER}" < ./Scripts/setup.sql
