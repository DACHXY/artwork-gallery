FROM dachxy/apache2-php-mssql

EXPOSE 80

WORKDIR /var/www/html

COPY . /var/www/html