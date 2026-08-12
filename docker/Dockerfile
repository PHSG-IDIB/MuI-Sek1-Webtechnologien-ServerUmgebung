FROM php:8.2-apache

# Notwendige System-Pakete installieren
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libsqlite3-dev \
    unzip \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl pdo pdo_sqlite opcache exif gd

# Composer global installieren
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Apache mod_rewrite aktivieren
RUN a2enmod rewrite

# Document Root anpassen
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Entrypoint-Skript kopieren und ausführbar machen
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Arbeitsverzeichnis festlegen
WORKDIR /var/www/html

# Start-Skript als Standardbefehl setzen
CMD ["entrypoint.sh"]
