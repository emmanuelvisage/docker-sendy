#!/bin/sh

# By default start up apache in the foreground, override with /bin/bash for interative.
# start cron

printenv | sed 's/^\(.*\)$/export \1/g' | grep -E "^export SENDY|^export MYSQL" > /root/project_env.sh

cron

/usr/sbin/apache2ctl -k stop

rm -f /var/run/apache2/apache2.pid

/usr/sbin/apache2ctl -D FOREGROUND