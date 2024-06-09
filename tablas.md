## Tabla usuarios
- ID (primary key)
- nombreCompleto
- username
- password
- fechaNacimiento

## Tabla publicaciones
- ID (primary key)
- user (foreign key)
- fechaPublicacion (datetime)
- contenido (varchar(250 máximo))
