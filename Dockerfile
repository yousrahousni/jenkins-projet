# Étape 1 : Utiliser une image PHP officielle avec Apache
FROM php:8.1-apache

# Étape 2 : Copier les fichiers de votre application dans le conteneur
COPY . /var/www/html/

# Étape 3 : Installer les extensions nécessaires (exemple : PDO MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Étape 4 : Configurer les permissions des fichier
RUN chown -R www-data:www-data /var/www/html

# Étape 5 : Exposer le port 80 pour l'application web
EXPOSE 80
