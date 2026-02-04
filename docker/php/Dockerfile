FROM serversideup/php:beta-8.3-fpm-nginx

COPY zzz-custom-php.ini /usr/local/etc/php/conf.d/

USER root

# Install the intl extension with root permissions
RUN install-php-extensions gd
RUN install-php-extensions bcmath

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -f \
    && apt-get install -y default-mysql-client/stable \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ARG USER_ID
ARG GROUP_ID
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID
RUN docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

USER www-data
