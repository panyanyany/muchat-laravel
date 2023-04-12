FROM laravelsail/php82-composer:latest as builder

COPY . /app
WORKDIR /app

RUN docker-php-ext-install pdo pdo_mysql zip

RUN composer install

#ENV DB_HOST=127.0.0.1 # 不要在这里设置，影响不到 server，但会影响到 cli，导致两者设置不一致

RUN php artisan orchid:install

RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash - &&\
    apt-get install -y nodejs &&\
    npm install -g yarn

RUN yarn

ENV WAIT_VERSION 2.11.0
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/$WAIT_VERSION/wait /wait
RUN chmod +x /wait

CMD php artisan serve --host=0.0.0.0
