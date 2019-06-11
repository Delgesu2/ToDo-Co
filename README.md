ToDoList
========

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/39c7f51f19ab45af9fba2fb15905a707)](https://app.codacy.com/app/Delgesu2/ToDo-Co?utm_source=github.com&utm_medium=referral&utm_content=Delgesu2/ToDo-Co&utm_campaign=Badge_Grade_Dashboard)

ToDo-Co
-------
Projet n°8 : Améliorez une application existante !

*Téléchargez ce projet ou clonez-le (Git clone)*

##Prérequis
+   PHP 7.2
+   MySQL
+   Symfony 3.4

##Adresse du site en démonstration 
https://p8todo.devxdemo.eu

##Installation
Pour installer le projet, vous devez le cloner ou le télécharger:
SSH:`git@github.com:Delgesu2/ToDo-Co.git` ou HTTPS:`https://github.com/Delgesu2/ToDo-Co.git`
Pour le faire tourner sur votre machine en local, vous pouvez
installer MAMP (ou WAMP pour Windows, ou LAMP pour Linux).

1.  Exécuter la commande `composer install` pour mettre à jour les dépendances.

2. Configurer la base de données dans `app/config/parameters.yml`. Le modèle est `app/config/parameters.yml.dist`
Le mot de passe de la base de données est celui attribué à l'utilisateur désigné.

3. Modifier `app/config/redis.yml`, notamment le dsn. 

4.  Exécuter `php bin/console doctrine:database:create` et `php bin/console doctrine:schema:update --force` pour créer la base de données.

5.  Exécuter `php bin/console doctrine:fixtures:load` pour charger les *fixtures*.

6.  Faire pointer le serveur vers le dossier /web

7. Activer Redis pour un déploiement sur un serveur distant (hébergeur) ou taper `redis-server` en local.

8.  Taper `composer require symfony/apache-pack`

9.  Dans la console, taper `php bin/console cache:clear --env prod`