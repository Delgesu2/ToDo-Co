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
Pour installer le projet, vous devez le cloner ou le télécharger. 
Pour le faire tourner sur votre machine en local, vous pouvez
installer MAMP (ou WAMP pour Windows, ou LAMP pour Linux).

1.  Exécuter la commande `composer install` pour mettre à jour les dépendances.

2.  Exécuter `php bin/console doctrine:database:create` et 
`php bin/console doctrine:schema:update --force` pour créer la base de données.

3.  Installer une dépendance de fixture comme AliceBundle: `composer require --dev hautelook/alice-bundle `

4.  Exécuter `php bin/console hautelook:fixtures:load` pour charger les *fixtures*.

5.  Installer Redis: `composer require snc/redis-bundle`

6.  Lancer le serveur Redis: `redis-server`

7.  Lancer le serveur Apache

Sur un serveur distant, faire pointer le serveur vers le dossier /web
8.  Taper `composer require symfony/apache-pack`

9.  Dans la console, taper `php bin/console cache:clear`