FROM small-shop/php-fpm:latest

ARG NODE_VERSION=10.15.1
ENV NODE_VERSION ${NODE_VERSION}

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

RUN git config --global http.sslVerify false;

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc

RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.1/install.sh | bash && \
    . /root/.nvm/nvm.sh && \
    nvm install ${NODE_VERSION} && \
    nvm use ${NODE_VERSION} && \
    nvm alias ${NODE_VERSION} && \
    npm install -g vue-cli && \
    echo "" >> ~/.bashrc && \
    echo 'export NVM_DIR="${HOME}/.nvm"' >> ~/.bashrc && \
    echo '[ -s "/root/.nvm/nvm.sh" ] && . "/root/.nvm/nvm.sh"  # This loads nvm' >> ~/.bashrc && \
    echo "export PATH=${PATH}:/bin/versions/node/v${NODE_VERSION}/bin" >> ~/.bashrc

ENV PATH $PATH:/bin/versions/node/v${NODE_VERSION}/bin

CMD ["php-fpm"]

EXPOSE 9000 9001