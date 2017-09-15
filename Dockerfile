# Dockerfile
# FROM nimmis/apache-php5
FROM nimmis/apache-php7
MAINTAINER COLAB MULTIMEDIA <support@teamcolab.com>

# Update all packages to latest and nstall Basic Server Packages
RUN apt-get update -y && apt-get install -y openssh-server git-core openssh-client \
    curl build-essential apt-transport-https openssl libreadline6 libreadline6-dev \
    curl zlib1g zlib1g-dev libssl-dev libyaml-dev libsqlite3-dev sqlite3 libxml2-dev \
    libxslt-dev autoconf libc6-dev ncurses-dev automake libtool bison subversion pkg-config

# install WP CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# Install RVM, Ruby 2.1.2, and the Bundler gem
RUN gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3 7D2BAF1CF37B13E2069D6956105BD0E739499BDB
RUN curl -sSL https://get.rvm.io | bash -s stable
RUN ["/bin/bash", "-l", "-c", "rvm requirements; rvm install 2.1.2; gem install bundler --no-ri --no-rdoc"]
RUN echo 'source /etc/profile.d/rvm.sh' >> ~/.bashrc

# Install NVM / Node
ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION stable
RUN curl https://raw.githubusercontent.com/creationix/nvm/v0.25.0/install.sh | bash \
    && source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default
ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH      $NVM_DIR/v$NODE_VERSION/bin:$PATH

# Install Yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
  && apt-get update \
  && apt-get install yarn -y

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Build script options
# Enable for sites that use these build routines

# Bower
# RUN echo '{ "allow_root": true }' > /root/.bowerrc
# RUN npm install bower -g

# Gulp
# RUN npm install gulp -g

# Configuration Files
COPY docker-apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# Expose 80 (HTTP), 3000 (browsersync)
EXPOSE 80
EXPOSE 3000

# Permissions and rewrites
RUN a2enmod rewrite
RUN usermod -u 1000 www-data

ENTRYPOINT ["/docker-entrypoint.sh"]
