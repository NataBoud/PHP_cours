CREATE DATABASE IF NOT EXISTS exercice03m2ilearning CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE exercice03m2ilearning;

CREATE TABLE status
(
    id    INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL
);

CREATE TABLE module
(
    id        INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name      VARCHAR(50) NOT NULL,
    start     DATETIME    NOT NULL,
    finish    DATETIME    NOT NULL,
    status_id INT,
    CONSTRAINT fk_status_id FOREIGN KEY (status_id) REFERENCES status (id)
);

CREATE TABLE tag
(
    id    INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL
);

CREATE TABLE module_tag
(
    module_id  INT NOT NULL,
    tag_id     INT NOT NULL,
    created_at DATETIME DEFAULT NOW(),
    PRIMARY KEY (module_id, tag_id),
    CONSTRAINT fk_tag_id FOREIGN KEY (tag_id) REFERENCES tag (id),
    CONSTRAINT fk_module_id FOREIGN KEY (module_id) REFERENCES module (id)
);

-- Créer des enregistrements pour alimenter la table status
INSERT INTO status (title) VALUE ('non-acquis'), ('en cours d''acquisition'), ('maîtrisé');

INSERT INTO module (name, start, finish, status_id) VALUE
    ('PHP-PDO', '2024-03-25', '2024-03-29', 3),
    ('Figma', '2023-11-27', '2023-11-29', 2),
    ('Node.js', '2024-02-26', '2024-03-01', 3);

INSERT INTO tag
    (title)
VALUES ('frontend'),
       ('backend'),
       ('infra'),
       ('javascript'),
       ('php');

INSERT INTO module_tag
    (module_id, tag_id)
VALUES (1, 5),
       (1, 1),
       (2, 1),
       (2, 4),
       (3, 2),
       (3, 4);