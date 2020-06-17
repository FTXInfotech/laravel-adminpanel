FROM php:7.3-apache-stretch

ENV LARAVEL_VERSION 5.6
ENV INSTALL_DIR /var/www/html
ENV COMPOSER_HOME /var/www/.composer/

# Install common tools and libraries
RUN apt-get update && apt-get install -y \
  cron \
  git \
  gzip \
  libfreetype6-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libxslt1-dev \
  libmagickwand-dev \
  lsof \
  mysql-client \
  vim \
  zip \
  unzip \
  curl \
  openssl \
  libssl-dev \
  libcurl4-openssl-dev

RUN pecl install imagick-3.4.3 \
  && pecl install mongodb

# http://devdocs.magento.com/guides/v2.0/install-gde/system-requirements.html
RUN docker-php-ext-install bcmath \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install gd \
  && docker-php-ext-install intl \
  && docker-php-ext-install mbstring \
  && docker-php-ext-install opcache \
  && docker-php-ext-install pdo_mysql \
  #&& docker-php-ext-install zip \
  && docker-php-ext-install xml \
  && docker-php-ext-install ctype \
  && docker-php-ext-install json \
  && docker-php-ext-enable imagick \
  && docker-php-ext-install bz2 \
  && docker-php-ext-install exif \
  && docker-php-ext-install sockets \
  && docker-php-ext-enable mongodb

# Install Node, Npm
RUN apt-get install -y gnupg \
  && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
  && apt-get install -y nodejs \
  && mkdir /var/www/.config /var/www/.npm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Make sure the volume mount point is empty
RUN rm -rf /var/www/html/*

# Set www-data as owner for /var/www
RUN chown -R www-data:www-data /var/www/
RUN chmod -R g+w /var/www/

# add apache modules and configuration
RUN a2enmod rewrite \
	&& a2enmod headers \
  && a2enmod expires \
  && echo "memory_limit=2048M" > /usr/local/etc/php/conf.d/memory-limit.in
  #&& echo "max_allowed_packet = 2048M" >> /etc/mysql/mysql.conf.d/mysqld.cnf

# Remove unnecssary modules
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# copy project files
COPY . /var/www/html
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini

#EXPOSE 8080

WORKDIR $INSTALL_DIR