# CV - PHP
```
  
  /$$$$$$  /$$    /$$                     /$$$$$$$  /$$   /$$ /$$$$$$$       
 /$$__  $$| $$   | $$                    | $$__  $$| $$  | $$| $$__  $$      
| $$  \__/| $$   | $$                    | $$  \ $$| $$  | $$| $$  \ $$      
| $$      |  $$ / $$/       /$$$$$$      | $$$$$$$/| $$$$$$$$| $$$$$$$/      
| $$       \  $$ $$/       |______/      | $$____/ | $$__  $$| $$____/       
| $$    $$  \  $$$/                      | $$      | $$  | $$| $$            
|  $$$$$$/   \  $/                       | $$      | $$  | $$| $$            
 \______/     \_/                        |__/      |__/  |__/|__/            
                                                                             
                                                                             
                                                                             

```

## Description

Ce projet est un site web permettant aux utilisateurs de créer, gérer et afficher des CV et portfolios. Il inclut plusieurs fonctionnalités pour la gestion des CV, des projets et facilite les interactions entre utilisateurs, notamment via l'envoi d'e-mails.

## Fonctionnalités

- **Création de compte** : Chaque utilisateur peut créer un compte, se connecter et se déconnecter.
- **Création de CV** : Possibilité de créer un CV à partir de modèles prédéfinis.
- **Liste des projets** : Les utilisateurs peuvent ajouter une liste de projets réalisés qui seront visibles sur leur CV.
- **Voir les CV des autres utilisateurs** : Chaque utilisateur peut consulter les CV des autres utilisateurs du site.
- **Télécharger le CV en PDF** : Le CV peut être généré et téléchargé au format PDF.
- **Envoyer un e-mail directement à un utilisateur** : Une option pour contacter l'utilisateur via un e-mail est disponible sur son profil.

## Prérequis

Avant de commencer, assurez-vous d'avoir Docker sur votre machine :

- [Docker](https://www.docker.com/get-started) : Docker permet de lancer et d'exécuter l'application dans des conteneurs, ce qui simplifie l'installation et l'exécution du projet sans avoir besoin d'installer manuellement PHP, MySQL, etc.

## Installation et Lancement du Projet

Suivez ces étapes pour cloner, installer et lancer le projet sur votre machine :

1. **Cloner le dépôt du projet**
    - Ouvrez un terminal (ou invite de commande).
    - Exécutez la commande suivante pour cloner le projet depuis GitHub :
      ```bash
      git clone https://github.com/MardinliG/PHP-Ynov-Mardinli-Guillaume.git
      ```
    - Cela va créer un dossier  contenant tous les fichiers du projet.
    - Ouvrez Docker installé précedement

2. **Lancement du Projet**
    - Dans le terminal, naviguez dans le dossier du projet cloné :
      ```bash
      cd .\Docker\
      ```
    - Executez la commande pour lancer le projet
      ```bash
      docker-compose up 
      ```

  **⚠️ Important :**

  - Lors de votre premier lancement vous drevez mettre en place la base de donnée. 
  
    - Pour ce faire veuillez vous rendre dans l'adminer via l'adresse [127.0.0.1:8080](http://127.0.0.1:8080)
    - Connectez vous avec l'utilisateur : `root` et le Mot de passe : `root`
    - A gauche de la page vous pourrez faire une requete SQL, **Copiez et Collez** le fichier `setup.sql` quise situe dans le dossier `database` et **Executez** la requete.

    - Il est important de modifier le fichier `config.php` qui se situe dans le dossier `contact` avec votre adresse mail et votre mot de passe afin de contacter les autres utilisateurs

4. **Accéder à l'application**
    - Une fois que vous avez configurer la base de donnée vous pouvez relancer le projet et vous rendre a l'adresse suivante : 
    
      [127.0.0.1](http://127.0.0.1)

5. **Utilisation de l'application**
    - Vous pouvez maintenant commencer à utiliser l'application en créant un compte, en vous connectant, et en commençant à remplir votre CV et portfolio !

6. *Informations complementaires*
  - Le premier utilisateur créé est par defaut administrateur.
    - Un Administrateur peut changer le role d'un utilisateur et choisir si son cv est publié dans la galerie des CVs. *(possibilité de supprimer un utilisateur prochainement)*
    - L'adresse du panneau d'administration :
    [127.0.0.1/admin/admin.php](http://127.0.0.1/admin/admin.php) 

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