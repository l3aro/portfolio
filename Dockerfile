FROM ghcr.io/l3aro/docker-laravel-base:main AS base

WORKDIR /var/www/html

FROM base AS dev

USER root

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    tmux \
    git \
    vim \
    screen \
    openssh-client \
    lazygit && \
    rm -rf /var/lib/apt/lists/*

USER www-data

RUN cp /package/custom/config/.tmux.conf /var/www/.tmux.conf
RUN cp /package/custom/config/.vimrc /var/www/.vimrc
RUN chown www-data:www-data /var/www/.tmux.conf
RUN chown www-data:www-data /var/www/.vimrc

FROM base AS prod

USER root

RUN rm -f public/hot

RUN cp -r /package/custom/entrypoint.d/ /etc/entrypoint.d/
RUN chmod 755 /etc/entrypoint.d/

COPY --chown=www-data:www-data . /var/www/html

ENV AUTORUN_ENABLED=true
ENV PHP_OPCACHE_ENABLE=1
ENV AUTORUN_LARAVEL_MIGRATION_ISOLATION=true

USER www-data
