ToDoList
========
ToDo-Co
-------
Projet n°8 : Améliorez une application existante !

*Téléchargez ce projet ou clonez-le (Git clone)*

##Prérequis
+   PHP 7.2
+   MySQL
+   Symfony 3.4

##Installation
Pour installer le projet, vous devez le cloner ou le télécharger:
`git@github.com:Delgesu2/ToDo-Co.git`
Pour le faire tourner sur votre machine en local, vous pouvez
installer MAMP (ou WAMP pour Windows, ou LAMP pour Linux).

1.  Exécuter la commande `composer install` pour mettre à jour les dépendances.

2. Configurer la base de données dans `app/config/parameters.yml`. Le modèle est `app/config/parameters.yml.dist`

3. Modifier `app/config/redis.yml`, notamment le dsn. 

4.  Exécuter `php bin/console doctrine:database:create` et 
`php bin/console doctrine:schema:update --force` pour créer la base de données.

5.  Exécuter `php bin/console doctrine:fixtures:load` pour charger les *fixtures*.

6.  Lancer le serveur Redis: `redis-server`

7.  Lancer le serveur Apache

Sur un serveur distant, faire pointer le serveur vers le dossier /web

8.  Taper `composer require symfony/apache-pack`

9.  Dans la console, taper `php bin/console cache:clear`