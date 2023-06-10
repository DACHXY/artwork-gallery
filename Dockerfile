FROM dachxy/apache2-php-mssql

EXPOSE 80

# 刪除容器中的所有 php session 暫存資料
RUN rm -rf /var/lib/php/sessions/*

WORKDIR /var/www/html

COPY . /var/www/html