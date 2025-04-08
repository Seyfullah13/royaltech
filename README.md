
Royaltech-Installation et Configuration

#Prérequis
PHP (version8.2 ou supérieur)
Composer (pour la gestion des dépendances PHP)
Symfony CLI ( outil de ligne de commande pour Symfony)
MYSQL(ou un autre système de base de données compatible avec Dotrine)

# Cloner le projet disponible sur git
git clone <https://github.com/Seyfullah13/royaltech>
cd royaltech

# Installer les dépendances du projet en utilisant Composer:
Commande: composer install

#Configurer l'URL de la base de données dans le fichier .env:
DATABASE_URL="mysql://root:@127.0.0.1:3306/royaltech"

#Création de la Base de Données et appliquez le schéma en utilisant mes commandes suivantes:
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

#Démarrage de l'Application:Pour démarrer le serveur local, utiliser la commande:
symfony server:start
Accèdez ensuite à l'application dans un navigateur via http://localhost:8000.
