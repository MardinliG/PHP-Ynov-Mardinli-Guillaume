# CV/Portfolio en PHP

## Description

Ce projet est un site web permettant aux utilisateurs de créer, gérer et afficher des CV et portfolios. Il inclut plusieurs fonctionnalités pour la gestion des CV, des projets et facilite les interactions entre utilisateurs, notamment via l'envoi d'e-mails.

## Fonctionnalités

- **Création de compte / Connexion / Déconnexion** : Chaque utilisateur peut créer un compte, se connecter et se déconnecter.
- **Création de CV avec un template esthétique** : Possibilité de créer un CV à partir de modèles prédéfinis avec un design professionnel.
- **Liste des projets** : Les utilisateurs peuvent ajouter une liste de projets réalisés qui seront visibles sur leur portfolio.
- **Voir les CV des autres utilisateurs** : Chaque utilisateur peut consulter les CV des autres utilisateurs du site.
- **Télécharger le CV en PDF** : Le CV peut être généré et téléchargé au format PDF.
- **Envoyer un e-mail directement à un utilisateur** : Une option pour contacter l'utilisateur via un e-mail est disponible sur son profil.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [Docker](https://www.docker.com/get-started) : Docker permet de lancer et d'exécuter l'application dans des conteneurs, ce qui simplifie l'installation et l'exécution du projet sans avoir besoin d'installer manuellement PHP, MySQL, etc.

## Installation et Lancement du Projet

Suivez ces étapes pour cloner, installer et lancer le projet sur votre machine :

1. **Cloner le dépôt du projet**
    - Ouvrez un terminal (ou invite de commande).
    - Exécutez la commande suivante pour cloner le projet depuis GitHub :
      ```bash
      git clone https://github.com/MardinliG/PHP-Ynov-Mardinli-Guillaume.git
      ```
    - Cela va créer un dossier `cv-portfolio` contenant tous les fichiers du projet.

2. **Naviguer dans le répertoire**
    - Dans le terminal, naviguez dans le dossier du projet cloné :
      ```bash
      cd .\Docker\
      ```

3. **Configurer Docker**
    - Assurez-vous que Docker est bien installé et fonctionne correctement.
    - Le projet inclut un fichier `docker-compose.yml` qui contient toutes les configurations nécessaires pour lancer l'application avec PHP, MySQL, et PHPMyAdmin.
    - Exécutez la commande suivante pour lancer l'application à l'aide de Docker :
      ```bash
      docker-compose up 
      ```
    - Cette commande va :
        - Télécharger les conteneurs nécessaires (PHP, MySQL, PHPMyAdmin).
        - Configurer un serveur local où l'application sera disponible.
        - Lancer une base de données MySQL préconfigurée.

4. **Accéder à l'application**
    - Une fois que Docker a terminé de lancer les conteneurs, ouvrez votre navigateur et accédez à l'application à l'adresse suivante :
      ```
      127.0.0.1
      ```
    - Pour accéder à l'interface d'administration de la base de données via PHPMyAdmin (pour voir ou gérer les données) :
      ```
      127.0.0.1:8080
      ```
    - Les identifiants par défaut pour MySQL sont :
        - **Utilisateur** : `root`
        - **Mot de passe** : `root`

5. **Utilisation de l'application**
    - Vous pouvez maintenant commencer à utiliser l'application en créant un compte, en vous connectant, et en commençant à remplir votre CV et portfolio !

## Technologies utilisées

Le projet repose sur les technologies suivantes :

- **PHP** : Langage de programmation utilisé pour la logique serveur et la génération des pages web dynamiques.
- **MySQL** : Base de données pour stocker les informations utilisateurs, CV et projets.
- **HTML / CSS** : Langages pour structurer et styliser les pages web.
- **JavaScript** : Utilisé pour les fonctionnalités interactives sur le site.
- **Bootstrap**  : Framework CSS pour un design réactif et moderne.
- **Docker** : Plateforme de conteneurisation qui permet de lancer le projet sans avoir à configurer manuellement un serveur local ou une base de données.
- **PHPMyAdmin** : Interface web pour gérer la base de données MySQL.
- **FPDF** : Bibliothèque PHP pour générer et télécharger les CV en format PDF.
- **PHPMailer** : Bibliothèque PHP utilisée pour envoyer des e-mails.

## Auteur

Ce projet a été développé par [Mardinli Guillaume](https://github.com/MardinliG) durant son module PHP au sein de l'école Toulouse Ynov Campus.