FROM ghcr.io/l3aro/docker-laravel-base:8.4-nginx

WORKDIR /var/www/html

USER root

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libx11-xcb1 libxcomposite1 libasound2t64 libatk1.0-0 libatk-bridge2.0-0 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgbm1 libgcc1 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 libnss3 \
    tmux \
    git \
    vim \
    screen \
    openssh-client \
    lazygit && \
    npm install -g puppeteer && \
    rm -rf /var/lib/apt/lists/*

ARG USER_ID
ARG GROUP_ID
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID

USER www-data

RUN npx puppeteer browsers install chrome-headless-shell

RUN cp /package/custom/config/.tmux.conf /var/www/.tmux.conf
RUN cp /package/custom/config/.vimrc /var/www/.vimrc
RUN chown www-data:www-data /var/www/.tmux.conf
RUN chown www-data:www-data /var/www/.vimrc

# COPY --chmod=755 .docker/entrypoint.d/ /etc/entrypoint.d/
