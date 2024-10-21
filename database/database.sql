CREATE DATABASE if not exists API_REST;
USE API_REST;
CREATE TABLE if not exists genero (id_genero INT PRIMARY KEY auto_increment, 
genero VARCHAR(100));
CREATE TABLE if not exists grupo (id_grupo INT PRIMARY KEY auto_increment, 
grupo VARCHAR(100)); 
CREATE TABLE IF not exists album (id_album INT PRIMARY KEY auto_increment, album VARCHAR(100),
genero INT, grupo INT, anyo YEAR,
FOREIGN KEY(genero) REFERENCES genero(id_genero) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(grupo) REFERENCES grupo(id_grupo) ON DELETE CASCADE ON UPDATE CASCADE);
CREATE TABLE if not exists canciones (id_cancion INT PRIMARY KEY auto_increment, cancion VARCHAR(100),
album INT,
FOREIGN KEY(album) REFERENCES album(id_album) ON DELETE CASCADE ON UPDATE CASCADE);
INSERT INTO genero (genero) VALUES
("Rock"),
("Pop"),
("Heavy metal"),
("Death metal"),
("Rap");
INSERT INTO grupo (grupo) VALUES
("Linkin Park"),
("Michael Jackson"),
("Arch Enemy"),
("Nirvana"),
("Within Temptation"),
("Bruno Mars"),
("Ariana Puello"),
("Black Keys");
INSERT INTO album (album, genero, grupo, anyo) VALUES
("Hybrid Theory", 1, 1, 2000),
("Thriller", 2, 2, 1982),
("Nevermind", 1, 4, 1991),
("El camino", 1, 8, 2008);
INSERT INTO canciones (cancion, album) VALUES
("Papercut", 1),
("Crawling", 1),
("Thriller", 2),
("Billie Jean", 2)



