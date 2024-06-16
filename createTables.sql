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

INSERT INTO publicaciones (userID, fechaPublicacion, contenido) VALUES
(2, "2020-03-15 14:23:45", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(3, "2020-05-22 10:47:30", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(1, "2020-08-01 18:59:12", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(4, "2020-11-03 07:32:54", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(2, "2021-01-13 21:14:23", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(1, "2021-04-25 09:43:19", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(3, "2021-07-07 15:27:05", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(4, "2021-09-19 20:56:34", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(1, "2021-11-22 11:38:47", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(3, "2022-02-28 13:50:09", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(4, "2022-05-15 08:22:37", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(2, "2022-07-24 19:44:58", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(1, "2022-09-13 17:36:22", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(4, "2022-11-30 22:18:16", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(2, "2023-01-07 03:27:41", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(3, "2023-03-19 12:48:53", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(1, "2023-06-05 05:13:37", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(2, "2023-08-21 16:29:08", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(4, "2023-10-10 14:59:11", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia."),
(3, "2023-12-25 23:12:55", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem tempore praesentium iste modi? Voluptatibus praesentium
tenetur nemo, vel unde maiores nam dolores error odio impedit dicta nihil est molestiae quia.");

