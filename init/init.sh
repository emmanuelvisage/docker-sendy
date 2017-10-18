#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
cd "$parent_path"

mysql --host=mysql --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD -e "DROP DATABASE ${MYSQL_DATABASE};"
mysql --host=mysql --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE ${MYSQL_DATABASE};"

if [ -n "$SENDY_BASE_DATA_FILE" ]; then
    mysql --host=mysql --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < $SENDY_BASE_DATA_FILE
fi