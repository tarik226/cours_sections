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