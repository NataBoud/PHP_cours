CREATE DATABASE IF NOT EXISTS commandeTransaction CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE commandeTransaction;

CREATE TABLE IF NOT EXISTS client (
                                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                    firstname VARCHAR(50) NOT NULL,
                                    lastname VARCHAR(50) NOT NULL,
                                    adresse VARCHAR(255) NOT NULL,
                                    zipCode VARCHAR(10) NOT NULL,
                                    city VARCHAR(255) NOT NULL,
                                    telephone VARCHAR(20)
                                                                            );

CREATE TABLE IF NOT EXISTS commandes (
                                        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                        date DATETIME NOT NULL,
                                        total DECIMAL(10, 2),
                                        client_id INT,
                                        CONSTRAINT fk_client_id FOREIGN KEY(client_id) REFERENCES client(id)
    );
