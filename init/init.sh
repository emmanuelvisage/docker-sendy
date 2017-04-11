#!/bin/bash

parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
cd "$parent_path"

mysql --host=mysql-sendy --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD -e "DROP DATABASE ${MYSQL_DATABASE};"
mysql --host=mysql-sendy --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE ${MYSQL_DATABASE};"
mysql --host=mysql-sendy --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < ./data/sendy_table_structure.sql
mysql --host=mysql-sendy --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < ./data/sendy_base_data.sql
mysql --host=mysql-sendy --port=$MYSQL_PORT --user=root --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < ./data/sendy_users_$SENDY_ENV.sql
