FROM php:5.6-apache

COPY sources.list /etc/apt/sources.list

RUN apt-get -y update \
    && apt-get -y install --fix-missing vim wget zip zlib1g-dev \
        curl libcurl3 libcurl3-dev  libmcrypt-dev mysql-client libicu-dev \
        net-tools iputils-ping netcat \
    && rm -rf /var/lib/apt/lists/*

# Install xdebug
RUN curl https://xdebug.org/files/xdebug-2.5.5.tgz -o /tmp/xdebug-2.5.5.tgz \
    && pecl install /tmp/xdebug-2.5.5.tgz \
    && docker-php-ext-enable xdebug

# PHP5 Extensions
RUN docker-php-ext-install curl \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install mbstring

# Enable apache modules
RUN a2enmod rewrite headers

EXPOSE 80

ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]