-- Create database
CREATE DATABASE last_test;

-- Use the database
USE last_test;

CREATE TABLE admin (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL
);

CREATE TABLE personal_info (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               admin_id INT,
                               Profilpics VARCHAR(255) NOT NULL,
                               name VARCHAR(255) NOT NULL,
                               title VARCHAR(255) NOT NULL,
                               about TEXT NOT NULL,
                               FOREIGN KEY (admin_id) REFERENCES admin(id)
);

CREATE TABLE experiences (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             admin_id INT,
                             ExperienceTitle VARCHAR(255) NOT NULL,
                             company VARCHAR(255) NOT NULL,
                             period VARCHAR(255) NOT NULL,
                             description TEXT NOT NULL,
                             FOREIGN KEY (admin_id) REFERENCES admin(id)
);

CREATE TABLE skills (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        admin_id INT,
                        SkillName VARCHAR(255) NOT NULL,
                        level INT NOT NULL,
                        FOREIGN KEY (admin_id) REFERENCES admin(id)
);

CREATE TABLE projects (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          admin_id INT,
                          ProjectName VARCHAR(255) NOT NULL,
                          image VARCHAR(255) NOT NULL,
                          FOREIGN KEY (admin_id) REFERENCES admin(id)
);

CREATE TABLE contact (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         admin_id INT,
                         email VARCHAR(255) NOT NULL,
                         phone VARCHAR(255) NOT NULL,
                         location VARCHAR(255) NOT NULL,
                         linkedin VARCHAR(255) NOT NULL,
                         github VARCHAR(255) NOT NULL,
                         FOREIGN KEY (admin_id) REFERENCES admin(id)
);

DELIMITER //

CREATE TRIGGER after_admin_insert
    AFTER INSERT ON admin
    FOR EACH ROW
BEGIN
    INSERT INTO personal_info (admin_id, Profilpics, name, title, about) VALUES (NEW.id, 'lien photo de profil', 'Prenom', 'Titre', 'A propos');
    INSERT INTO contact (admin_id, email, phone, location, linkedin, github) VALUES (NEW.id, 'email', 'telephone', 'ville', 'lien linkedin', 'lien github');
    INSERT INTO projects (admin_id, ProjectName, image) VALUES (NEW.id, 'Nom du Projet 1', 'Lien de l image 1');
    INSERT INTO projects (admin_id, ProjectName, image) VALUES (NEW.id, 'Nom du Projet 2', 'Lien de l image 2');
    INSERT INTO skills (admin_id, SkillName, level) VALUES (NEW.id, 'Language 1', 5);
    INSERT INTO skills (admin_id, SkillName, level) VALUES (NEW.id, 'Language 2', 6);
    INSERT INTO skills (admin_id, SkillName, level) VALUES (NEW.id, 'Language 3', 7);
    INSERT INTO experiences (admin_id, ExperienceTitle, company ,period ,description) VALUES (NEW.id, 'Titre Experience', 'Entreprise', 'Période', 'Description');

END //

DELIMITER ;