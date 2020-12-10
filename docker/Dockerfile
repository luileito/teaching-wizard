FROM php:7.4-fpm-alpine

# Use the default production configuration
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ARG dir=web

# Note that this is executed in the context of the build, which is set to the root dir in the docker-compose.yml,
# so this includes the whole project
COPY . /usr/src
WORKDIR /usr/src/${dir}
