CREATE DATABASE db_s2_ETU004222;
USE db_s2_ETU004222;
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre ENUM('H', 'F'),
    email VARCHAR(100) UNIQUE,
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);


INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Anna', '2000-01-01', 'F', 'anna@mail.com', 'Antananarivo', 'test1', 'anna.jpg'),
('Bruno', '1999-05-12', 'H', 'bruno@mail.com', 'Toamasina', 'test2', 'Bruno.jpg'),
('Soa', '2001-03-22', 'F', 'soa@mail.com', 'Fianarantsoa', 'test3', 'claire.jpg'),
('Davida', '2002-07-10', 'H', 'davida@mail.com', 'Mahajanga', 'test4', 'david.jpg');


INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'), ('Bricolage'), ('Mécanique'), ('Cuisine');


INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Rouge à lèvres', 1, 1), ('Peigne', 1, 1), ('Perceuse', 2, 1), ('Marteau', 2, 1),
('Clé à molette', 3, 1), ('Fourchette', 4, 1), ('Poêle', 4, 1), ('Mixeur', 4, 1), ('Trousse maquillage', 1, 1);


INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Tournevis', 2, 2), ('Pince', 2, 2), ('Friteuse', 4, 2), ('Lisseur', 1, 2), ('Batteur', 4, 2),
('Tondeuse', 1, 2), ('Balance cuisine', 4, 2), ('Boîte à outils', 2, 2), ('Casque audio', 1, 2), ('Spatule', 4, 2);


INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Pompe vélo', 3, 3), ('Cric', 3, 3), ('Mixer Pro', 4, 3), ('Marteau piqueur', 2, 3), ('Planche à découper', 4, 3),
('Pinceau maquillage', 1, 3), ('Râpe', 4, 3), ('Couteau', 4, 3), ('Perceuse Pro', 2, 3), ('Grille-pain', 4, 3);


INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Friteuse XXL', 4, 4), ('Brosse cheveux', 1, 4), ('Scie', 2, 4), ('Tournevis électrique', 2, 4), ('Pompe à main', 3, 4),
('Micro-ondes', 4, 4), ('Fer à lisser', 1, 4), ('Lampe frontale', 2, 4), ('Mixeur blender', 4, 4), ('Perceuse sans fil', 2, 4);



INSERT INTO images_objet (id_objet, nom_image)
SELECT id_objet, CONCAT('image', id_objet, '.jpg') FROM objet;


INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-10'),
(3, 4, '2025-07-02', '2025-07-12'),
(5, 3, '2025-07-03', '2025-07-13'),
(7, 1, '2025-07-04', '2025-07-14'),
(10, 2, '2025-07-05', '2025-07-15'),
(12, 3, '2025-07-06', '2025-07-16'),
(15, 4, '2025-07-07', '2025-07-17'),
(18, 1, '2025-07-08', '2025-07-18'),
(21, 2, '2025-07-09', '2025-07-19'),
(24, 3, '2025-07-10', '2025-07-20');