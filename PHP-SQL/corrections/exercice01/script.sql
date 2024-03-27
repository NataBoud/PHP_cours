-- Création de la base de données avec le bon encodage
CREATE DATABASE IF NOT EXISTS exercice01 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- On se positionne sur la base de données
USE exercice01;

-- On créé la table avec ses colonnes et ses contraintes
CREATE TABLE IF NOT EXISTS student (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    email VARCHAR(255) NOT NULL
);