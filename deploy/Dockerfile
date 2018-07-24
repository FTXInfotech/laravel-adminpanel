FROM ubuntu:16.04

RUN apt-get update \
    && apt-get install -qy language-pack-en-base \
    && locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8

RUN  apt-get -y install apache2
RUN  a2enmod headers 
RUN  a2enmod rewrite


# add PPA for PHP 7
RUN apt-get install -y --no-install-recommends apt-utils
RUN apt update
RUN apt -y dist-upgrade

RUN apt remove --purge ca-certificates
RUN apt autoremove
RUN apt install ca-certificates

RUN apt-get install -y software-properties-common python-software-properties
RUN add-apt-repository -y ppa:ondrej/php


#  Adding php 7
RUN  apt-get update 
RUN  apt-get install -y php7.1 php7.1-fpm php7.1-cli php7.1-common php7.1-mbstring php7.1-gd php7.1-intl php7.1-xml php7.1-mysql php7.1-mcrypt php7.1-zip  
RUN  apt-get -y install libapache2-mod-php7.1 php7.1 php7.1-cli php-xdebug php7.1-mbstring sqlite3 php7.1-mysql php-imagick php-memcached php-pear curl imagemagick php7.1-dev php7.1-phpdbg php7.1-gd npm nodejs-legacy php7.1-json php7.1-curl php7.1-sqlite3 php7.1-intl apache2 vim git-core wget libsasl2-dev libssl-dev 

RUN apt-get -y install libsslcommon2-dev libcurl4-openssl-dev autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev 

RUN  apt-get install -y imagemagick graphicsmagick  
RUN  a2enmod headers 
RUN  a2enmod rewrite


ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
RUN ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR


# Update application repository list and install the Redis server. 
#RUN apt-get update && apt-get install -y redis-server




# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Setup the Composer installer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
    && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
    && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
    && php /tmp/composer-setup.php \
    && chmod a+x composer.phar \
    && mv composer.phar /usr/local/bin/composer

# Install composer dependencies
RUN echo pwd: `pwd` && echo ls: `ls` 



# RUN composer install


EXPOSE 80

# Expose default port
#EXPOSE 6379



VOLUME [ "/var/www/html" ,"/etc/mysql"]
WORKDIR /var/www/html


ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]

COPY . /var/www/html
COPY ./deploy/vhost.conf /etc/apache2/sites-available/000-default.conf


RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

RUN chown -R 777 /var/www/html/

RUN composer install

RUN php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"




