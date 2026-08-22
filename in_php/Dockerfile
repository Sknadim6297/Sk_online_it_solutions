FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . /var/www/html/

# Site runs at domain root on Render (not /SNF_TEAM/in_php/)
RUN sed -i 's|RewriteBase /SNF_TEAM/in_php/|RewriteBase /|' .htaccess \
    && sed -i 's|ErrorDocument 404 /SNF_TEAM/in_php/index.php|ErrorDocument 404 /index.php|' .htaccess \
    && mkdir -p storage/uploads/blog \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage

EXPOSE 80
