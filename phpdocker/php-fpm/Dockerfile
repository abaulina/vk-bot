
FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
    git \ 
    php8.2-pgsql; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN composer update