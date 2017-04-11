FROM ubuntu:latest
MAINTAINER Emmanuel Marboeuf <emmanuel@visage.job>

# Install apache, PHP, and supplimentary programs. openssh-server, curl, and lynx-cur are for debugging the container.
RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    apache2 php7.0 mysql-client php7.0-mysql libapache2-mod-php7.0 php-curl curl lynx-cur php7.0-xml cron

# Enable apache mods.
RUN a2enmod php7.0
RUN a2enmod rewrite

# Update the PHP.ini file, enable <? ?> tags and quieten logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid


# Expose apache.
EXPOSE 80

# Copy this repo into place.
ADD www /var/www/site

# Copy this repo into place.
ADD init /var/www/init

RUN chmod 777 /var/www/site/uploads

# Add autoresponders and scheduled files in the cron directory
ADD autoresponders /etc/cron.d/sendy-auto-responder-cron
ADD scheduled /etc/cron.d/sendy-scheduled-cron

ADD run.sh /usr/local/bin/run.sh

# Give execution rights on the cron job
RUN chmod 0644 -R /etc/cron.d

RUN chmod 755 /usr/local/bin/run.sh
RUN chmod 755 /var/www/init/init.sh

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Update the default apache site with the config we created.
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

CMD ["/usr/local/bin/run.sh"]