#!/bin/bash


if [ -e /pass/.htaccess ]
then
echo pouet
else
cp /app/.htaccess.exemple /pass/.htaccess
fi
if [ -e /pass/.htpass ]
then
echo pouet
else
cp /app/.htpass.exemple /pass/.htpass
fi
#chown -R www-data:staff /pass /DL


if [ -e /etc/php/5.6/apache2/php.ini ]
then
    sed -ri -e "s/^upload_max_filesize.*/upload_max_filesize = ${PHP_UPLOAD_MAX_FILESIZE}/" \
        -e "s/^post_max_size.*/post_max_size = ${PHP_POST_MAX_SIZE}/" /etc/php/5.6/apache2/php.ini
else
    sed -ri -e "s/^upload_max_filesize.*/upload_max_filesize = ${PHP_UPLOAD_MAX_FILESIZE}/" \
        -e "s/^post_max_size.*/post_max_size = ${PHP_POST_MAX_SIZE}/" /etc/php/7.3/apache2/php.ini
fi


sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=staff/" /etc/apache2/envvars

if [ -n "$APACHE_ROOT" ];then
    rm -f /var/www/html && ln -s "/app/${APACHE_ROOT}" /var/www/html
fi


if [ -n "$VAGRANT_OSX_MODE" ];then
    usermod -u $DOCKER_USER_ID www-data
    groupmod -g $(($DOCKER_USER_GID + 10000)) $(getent group $DOCKER_USER_GID | cut -d: -f1)
    groupmod -g ${DOCKER_USER_GID} staff


else
    # Tweaks to give Apache/PHP write permissions to the app
    chown -R www-data:staff /var/www
    chown -R www-data:staff /app
   # chown -R www-data:staff /pass
   # chown -R www-data:staff /DL
fi
locale-gen fr_FR.UTF-8 && export LANG=fr_FR.UTF-8 && export LC_ALL=fr_FR.UTF-8
exec supervisord -n
