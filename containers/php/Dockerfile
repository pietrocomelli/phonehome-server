FROM php:8.1.11-fpm-alpine as base
WORKDIR /var/www/html/
COPY --from=mlocati/php-extension-installer:1.5.43 /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
        mysqli \
        opcache \
        pdo_mysql \
        redis \
        zip
COPY --from=composer:2.4.3 /usr/bin/composer /usr/local/bin/composer

FROM base as vendor
COPY composer.json .
COPY composer.lock .
RUN composer check-platform-reqs \
    && composer i --optimize-autoloader --no-scripts --no-ansi --no-interaction --no-progress --prefer-dist \
    && mv vendor vendor_test \
    && composer i --optimize-autoloader --no-scripts --no-dev --no-ansi --no-interaction --no-progress --prefer-dist

FROM base as application
COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database ./database
COPY lang ./lang
COPY public ./public
COPY resources ./resources
COPY routes ./routes
COPY --chown=www-data:www-data storage ./storage
COPY artisan .
COPY composer.json .
COPY composer.lock .

FROM base as testing
ENV APP_KEY=base64:Y6qJHTnzxMzrqw3wrm/jMsWACRWTykYARWxw9mkPqC8=
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=:memory:
RUN install-php-extensions xdebug
COPY --from=application /var/www/html /var/www/html
COPY --from=vendor /var/www/html/vendor_test /var/www/html/vendor
RUN composer run post-autoload-dump --no-ansi --no-plugins
COPY tests ./tests
COPY phpunit.xml .
RUN XDEBUG_MODE=coverage php artisan test --parallel --coverage-cobertura coverage.cobertura.xml

FROM base as production
RUN apk add --no-cache \
        fcgiwrap \
        netcat-openbsd \
        procps \
        tini \
    && echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY containers/php/conf.d /usr/local/etc/php/conf.d
ADD https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/v0.5.0/php-fpm-healthcheck /usr/local/bin/
ADD https://github.com/eficode/wait-for/releases/download/v2.2.3/wait-for /usr/local/bin/
COPY containers/php/entrypoint.sh /usr/local/bin/entrypoint
COPY --from=application /var/www/html /var/www/html
COPY --from=vendor /var/www/html/vendor /var/www/html/vendor
RUN chmod u+x /usr/local/bin/php-fpm-healthcheck \
    && chmod u+x /usr/local/bin/wait-for \
    && chmod u+x /usr/local/bin/entrypoint \
    && composer run post-autoload-dump --no-ansi --no-plugins \
    && echo -n "opcache.max_accelerated_files=" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo $(find . -name "*.php" | wc -l | awk '{print (int($1/1000)+2)*1000}') >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && rm /usr/local/bin/composer \
    && rm /usr/local/bin/install-php-extensions
ENTRYPOINT ["entrypoint"]