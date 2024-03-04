FROM duyler/php-fpm-zts

RUN apt-get update
RUN apt-get -y install librabbitmq-dev

RUN pecl install amqp
RUN docker-php-ext-enable amqp

# Run the ReactPHP server
CMD php runtime/react.php
