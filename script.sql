CREATE DATABASE zoo;
use zoo;
CREATE TABLE habitas (
    Id_h INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (50),
    descreption VARCHAR (255),
);

CREATE TABLE animals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (50),
    Type_alimentaire VARCHAR (255);
    Id_habitat INT,
    FOREIGN KEY (Id_habitat) REFERENCES habitas(Id_h)
);

INSERT INTO habitas (name, descreption)
VALUES("Savanna", "The savanna is a hot, dry grassland with scattered trees.") ,("Jungle", "The jungle is a dense, tropical forest with many plants and tall trees."),
("Desert", "The desert is a very dry place with little rain."),("Ocean", "The ocean is a large body of salt water that covers most of the Earth")
  
 INSERT INTO animals (name, type_alimentaire, image, Id_habitat)
VALUES("Jaguar", "Herbivore","photo.jpg", 1)

UPDATE animals
SET type_alimentaire = "Carnivorous"
WHERE id=8

DELETE FROM animals 
WHERE id= 3

SELECT `name` FROM animals WHERE id=1


 
 SELECT habitas.name AS habitat
FROM animals
JOIN habitas ON animals.Id_habitat = habitas.Id_h
WHERE animals.name = 'Lion';
  
  SELECT type_alimentaire FROM animals