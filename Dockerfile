FROM xampp/app:8.2 as phalcon

ARG DEBIAN_FRONTEND=noninteractive
USER root
RUN apt update -y && \
    apt-get install libpcre3-dev -y && \
    pecl channel-update pecl.php.net && \
    pecl install phalcon-5.6.0 && \
    docker-php-ext-enable phalcon

FROM phalcon as phalcon-migrations

USER app:app
