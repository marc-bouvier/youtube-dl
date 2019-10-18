FROM phusion/baseimage:0.11
MAINTAINER Nunurs
ENV REFRESHED_AT 18-10-2019

# based on dgraziotin/lamp
# MAINTAINER Daniel Graziotin <daniel@ineed.coffee>

ENV DOCKER_USER_ID 501 
ENV DOCKER_USER_GID 20

ENV USER_ID 1000
ENV USER_GID 50


# Tweaks to give Apache/PHP write permissions to the app
RUN usermod -u ${USER_ID} www-data && \
    usermod -G staff www-data

RUN groupmod -g $(($USER_GID + 10000)) $(getent group $USER_GID | cut -d: -f1)
RUN groupmod -g ${USER_GID} staff

# Install packages
ENV DEBIAN_FRONTEND noninteractive
RUN add-apt-repository -y ppa:ondrej/php && \
  apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C && \
  apt-get update && \
  apt-get -y upgrade && \
  apt-get -y install supervisor wget git apache2 php-xdebug libapache2-mod-php php-mysql pwgen php-apcu php7.1-mcrypt php-gd php-xml php-mbstring php-gettext zip unzip php-zip curl php-curl python3-setuptools ffmpeg mkvtoolnix aria2 && \
  apt-get -y autoremove && \
  echo "ServerName localhost" >> /etc/apache2/apache2.conf

#Installation de PIP
RUN cd /tmp
RUN wget -O /tmp/get-pip.py https://bootstrap.pypa.io/get-pip.py
RUN python3 /tmp/get-pip.py

#définition des variables local pour UTF8
RUN locale-gen fr_FR.UTF-8 && export LANG=fr_FR.UTF-8 && export LC_ALL=fr_FR.UTF-8

#Upgrade de PIP et installation de youtube-dl
RUN pip install --upgrade pip
RUN pip install Flask
RUN pip install youtube-dl


# Add image configuration and scripts
ADD supporting_files/start-apache2.sh /start-apache2.sh
ADD supporting_files/run.sh /run.sh

RUN chmod 755 /*.sh
ADD supporting_files/supervisord-apache2.conf /etc/supervisor/conf.d/supervisord-apache2.conf

# Set PHP timezones de Europe/Paris
RUN sed -i "s/;date.timezone =/date.timezone = Europe\/Paris/g" /etc/php/7.3/apache2/php.ini
RUN sed -i "s/;date.timezone =/date.timezone = Europe\/Paris/g" /etc/php/7.3/cli/php.ini

# Add composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# config to enable .htaccess
ADD supporting_files/apache_default /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite


# Configure /app /pass /app/DL
RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html
ADD app/ /app
RUN chmod +x /app/DL.sh
RUN mkdir /app/DL && ln -s /app/DL /DL
RUN mkdir /pass && ln -s  /pass/.htaccess /app/.htaccess  && ln -s /pass/.htpass /app/.htpass


#Environment variables to configure php
ENV PHP_UPLOAD_MAX_FILESIZE 50M
ENV PHP_POST_MAX_SIZE 50M
ENV VIRTUAL_HOST domain.lan
RUN echo nameserver 8.8.8.8 > /etc/resolv.conf


# Add volumes for the app
VOLUME  ["/DL", "/pass" ]

EXPOSE 80
CMD ["/run.sh"]
