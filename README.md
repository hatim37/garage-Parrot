# Garage V.Parrot

Ce projet est une application créée dans le cadre d'une évaluation de fin de formation de développeur web.
Il a été conçu avec le framework Symfony 6.3 et php 8.1.
Cette application est un site vitrine qui met en avant les prestations d'un garage.
Les informations affichées sur le site sont modifiables grâce à un gestionnaire de contenu.

----------------------

## Instructions  

### Pré-requis

- Composer version 2.5.1
- PHP 8.1
- Symfony 6.3


### Déploiement local 

- Récupérer le projet github en local :  

    Depuis votre terminal taper :
    
         git clone https://github.com/hatim37/garage-Parrot.git


- Installer les dépendances, depuis le terminal :

        composer install


- La clé APP_SECRET n'est pas fournie, pour générer une Clé dans votre ".env" taper la commande suivante dans votre terminal :

        php bin/console secret:regenerate-app-secret .env


- Configurer votre fichier .env pour se connecter à la base de données: 

        DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"


- Création de la base de données :

        php bin/console d:d:c


- Création des tables dans la base données :

        php bin/console d:m:m


- En environement "dev" vous pouvez générer des fixtures : 

        php bin/console doctrine:fixtures:load


- Compte administrateur :

    - Vous pouvez créer un compte administrateur pour vous connectez et gérer la base de données. Saisir la commande :  

            php bin/console app:create-administrator

        Puis renseigner un nom, un prénom, un email et un mot de passe.
            

------------------------------

*Mes remerciements à tous les formateurs de studi-school qui déploient beaucoup d'efforts pour nous fournir des cours de qualité et nous transmettre les savoir-faires pour réussir notre projet professionnel.*