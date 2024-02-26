# Pantheon 7.2 appserver mock for Kalabox
#
# from https://github.com/kalabox/kalabox-app-pantheon/blob/v2.1/app/dockerfiles/pantheon-appserver/70/Dockerfile

FROM php:7.2-fpm

RUN mkdir /php

# Install the PHP extensions we need
RUN apt-get update && apt-get install -y \
  bzip2 \
  libbz2-dev \
  libc-client2007e-dev \
  libjpeg-dev \
  libkrb5-dev \
  libldap2-dev \
  libmagickwand-dev \
  libmcrypt-dev \
  libpng-dev \
  libpq-dev \
  libxml2-dev \
  mysql-client \
  python \
  imagemagick \
  xfonts-base \
  xfonts-75dpi \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  wkhtmltopdf \
  unzip \
  && pecl install imagick \
  && pecl install oauth \
  && pecl install redis \
  && pecl install xdebug \
  && docker-php-ext-configure gd --with-freetype-dir=/usr --with-png-dir=/usr --with-jpeg-dir=/usr \
  && docker-php-ext-configure imap --with-imap-ssl --with-kerberos \
  && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
  && docker-php-ext-enable imagick \
  && docker-php-ext-enable oauth \
  && docker-php-ext-enable redis \
  && docker-php-ext-enable xdebug \
  && docker-php-ext-install \
  bcmath \
  bz2 \
  calendar \
  gd \
  imap \
  ldap \
  mbstring \
  mysqli \
  opcache \
  pdo \
  pdo_mysql \
  soap \
  zip \
  sockets \
  && mkdir -p /srv/bin \
  && cd /srv/bin \
  && curl -fsSL "https://github.com/Medium/phantomjs/releases/download/v2.1.1/phantomjs-2.1.1-linux-x86_64.tar.bz2" | tar -xjv \
  && mv phantomjs-2.1.1-linux-x86_64/bin/phantomjs /srv/bin/phantomjs \
  && rm -rf phantomjs-2.1.1-linux-x86_64 && rm -f phantomjs-2.1.1-linux-x86_64.tar.bz2 \
  && chmod +x /srv/bin/phantomjs \
  && apt-get -y clean \
  && apt-get -y autoclean \
  && apt-get -y autoremove \
  && rm -rf /var/lib/apt/lists/* && rm -rf && rm -rf /var/lib/cache/* && rm -rf /var/lib/log/* && rm -rf /tmp/*

RUN apt-get update \
  && apt-get install -y nginx

# Support production image rewrite functionality
RUN echo "set \$production_url '0.0.0.0';" > /etc/nginx/snippets/production_images.conf

# Install Basic Server Packages
RUN apt-get install -y openssh-server git-core openssh-client curl
RUN apt-get install -y build-essential
RUN apt-get install -y apt-transport-https
RUN apt-get install -y openssl curl zlib1g zlib1g-dev libssl-dev libyaml-dev libsqlite3-dev sqlite3 libxml2-dev libxslt-dev autoconf libc6-dev ncurses-dev automake libtool bison subversion pkg-config gnupg dirmngr

# install WP CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install RVM, Ruby 2.1.2, and the Bundler gem - uncomment if needed
# RUN gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3 7D2BAF1CF37B13E2069D6956105BD0E739499BDB
# RUN curl -sSL https://get.rvm.io | bash -s stable
# RUN ["/bin/bash", "-l", "-c", "rvm requirements; rvm install 2.1.2; gem install bundler --no-ri --no-rdoc"]
# RUN echo 'source /etc/profile.d/rvm.sh' >> ~/.bashrc

# Install NVM / Node / Gulp
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION stable
RUN mkdir $NVM_DIR \
  && curl https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash \
  && . $NVM_DIR/nvm.sh \
  && nvm install $NODE_VERSION \
  && nvm alias default $NODE_VERSION \
  && nvm use default
ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH      $NVM_DIR/v$NODE_VERSION/bin:$PATH

# Add auto nvm on cd to bash
COPY config/bash/cdnvm.sh /root/cdnvm.sh
RUN echo '. /root/cdnvm.sh' >> /root/.bashrc

# Install Yarn
ENV APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE 1
RUN apt-key adv --fetch-keys https://dl.yarnpkg.com/debian/pubkey.gpg \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
  && apt-get update \
  && apt-get -y install yarn

EXPOSE 80
