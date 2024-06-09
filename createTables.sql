USE albertoBD;

 CREATE TABLE usuarios (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombreCompleto VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    fechaNacimiento DATE
)  ENGINE=INNODB;

INSERT INTO usuarios(nombreCompleto, username, password, fechaNacimiento) VALUES
("Usuario Administrador", "admin", "abc123.", "1970-01-02"),
("Ana Bouza", "ana", "casita123", "1997-12-02"),
("Alberto Vázquez", "alberto", "leagueoflegends", "1990-02-13"),
("Cris Puga", "cris", "casita+++", "1981-08-20");


CREATE TABLE publicaciones (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userID INT NOT NULL,
    fechaPublicacion DATETIME,
    contenido VARCHAR(250),
    CONSTRAINT fk_usuario FOREIGN KEY (userID)
        REFERENCES usuarios (ID)
        ON UPDATE CASCADE ON DELETE CASCADE
)  ENGINE=INNODB;
