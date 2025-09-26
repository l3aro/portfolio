FROM ghcr.io/l3aro/docker-laravel-base:main AS base

FROM base AS dev

USER root

RUN apk add --no-cache \
    tmux \
    git \
    vim \
    screen \
    openssh \
    lazygit

USER www-data

RUN cp /package/custom/config/.tmux.conf /home/www-data/.tmux.conf
RUN cp /package/custom/config/.vimrc /home/www-data/.vimrc
RUN chown www-data:www-data /home/www-data/.tmux.conf
RUN chown www-data:www-data /home/www-data/.vimrc

FROM base AS prod

WORKDIR /var/www/html

USER root

RUN rm -f public/hot

RUN cp -r /package/custom/entrypoint.d/ /etc/entrypoint.d/
RUN chmod 755 /etc/entrypoint.d/

COPY --chown=www-data:www-data . /var/www/html

ENV AUTORUN_ENABLED=true
ENV PHP_OPCACHE_ENABLE=1
ENV AUTORUN_LARAVEL_MIGRATION_ISOLATION=true

USER www-data
