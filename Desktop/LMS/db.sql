-- creation du base de données
CREATE DATABASE cours_section;
-- creation du tableau de course 
CREATE TABLE courses (
    -- l attribut id s'auto incremente lors de l ajout de nouveau cours
    id INT PRIMARY KEY AUTO_INCREMENT,
    -- le titre doit avoir 225 caras max et ne sera pas null 
    title VARCHAR(255) NOT NULL,
    descriptions TEXT,
    -- levell doit avoir une de 3 valeurs
    levell ENUM('Débutant', 'Intermédiaire', 'Avancé') NOT NULL,
    -- prend la date de creation comme valeur par defaut si aucun n est precise
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des sections
-- creation du tableau de sections
CREATE TABLE sections (
    -- l attribut id s'auto incremente lors de l ajout de nouveau cours
    id INT PRIMARY KEY AUTO_INCREMENT,
    -- l id du course est un cle etranger il faut le precider pour l identifire comme cle etrange apres  '
    course_id INT NOT NULL,
    -- le titre doit avoir 225 caras max et ne sera pas null 
    title VARCHAR(255) NOT NULL,
    content TEXT,
    -- attribut position de type int
    position INT NOT NULL,
    -- prend la date de creation comme valeur par defaut si aucun n est precise
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    -- identification du course_id comme reference au tableau courses
    CONSTRAINT fk_course
        FOREIGN KEY (course_id) REFERENCES courses(id)
        -- si je supprime le course ses secetions suppriment aussi 
        ON DELETE CASCADE
        -- si je modifier l 'id les sections change l attribut course_id
        ON UPDATE CASCADE
);
-- Insérer des cours
INSERT INTO courses (title, description, level, created_at)
VALUES
('Introduction à JavaScript', 'Cours pour apprendre les bases du langage JavaScript.', 'Débutant', NOW()),
('Bases de la Data Science', 'Découverte des outils et méthodes de la data science.', 'Intermédiaire', NOW()),
('Architecture Logicielle Avancée', 'Concepts avancés de conception et architecture logicielle.', 'Avancé', NOW());

-- Insérer des sections pour chaque cours
INSERT INTO sections (course_id, title, content, position, created_at)
VALUES
-- Sections du cours JavaScript
(1, 'Variables et Types', 'Présentation des variables et des types de données en JS.', 1, NOW()),
(1, 'Fonctions', 'Introduction aux fonctions et à leur utilisation.', 2, NOW()),
(1, 'DOM et Événements', 'Manipulation du DOM et gestion des événements.', 3, NOW()),

-- Sections du cours Data Science
(2, 'Introduction à Python', 'Bases de Python pour la data science.', 1, NOW()),
(2, 'Manipulation de données', 'Utilisation de pandas et numpy.', 2, NOW()),
(2, 'Visualisation', 'Création de graphiques avec matplotlib et seaborn.', 3, NOW()),

-- Sections du cours Architecture Logicielle
(3, 'Patrons de conception', 'Étude des principaux design patterns.', 1, NOW()),
(3, 'Microservices', 'Introduction aux architectures microservices.', 2, NOW()),
(3, 'Scalabilité et performance', 'Optimisation des systèmes distribués.', 3, NOW());
