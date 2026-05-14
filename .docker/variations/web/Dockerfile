FROM ghcr.io/l3aro/docker-laravel-base:8.4-nginx

USER root

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libx11-xcb1 libxcomposite1 libasound2t64 libatk1.0-0 libatk-bridge2.0-0 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgbm1 libgcc1 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 libnss3 \
    && npm install -g puppeteer

USER www-data

RUN npx puppeteer browsers install chrome-headless-shell

USER root

RUN chmod 755 /etc/entrypoint.d/

COPY --chmod=755 ./.docker/entrypoint.d/ /etc/entrypoint.d/

COPY --chown=www-data:www-data . /var/www/html

WORKDIR /var/www/html

ARG FLUX_USERNAME
ARG FLUX_LICENSE_KEY
RUN composer config http-basic.composer.fluxui.dev $FLUX_USERNAME $FLUX_LICENSE_KEY \
    && composer install --no-dev --optimize-autoloader \
    && rm -f auth.json

RUN pnpm install && pnpm build

ENV AUTORUN_ENABLED=true
ENV PHP_OPCACHE_ENABLE=1

USER www-data
