FROM richarvey/nginx-php-fpm:1.7.2

# Copier les fichiers sources
COPY . /var/www/html

# Définir le webroot pour Laravel
ENV WEBROOT /var/www/html/public

# Installer les dépendances Laravel avec Composer
RUN apk add --no-cache git unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configurer les variables d'environnement
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Commande de démarrage
CMD ["/start.sh"]
