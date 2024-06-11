<?php
session_start();

echo print_r($_SESSION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Datos para la conexión a la BD
  $host = "172.20.0.2";
  $dbname = "albertoBD";
  $serveruser = "admin";
  $serverpasswd = "abc123.";
  $charset = "utf8mb4";

  // Sentencia para conectarnos a la BD
  $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

  // Opciones para la BD
  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  // Si la conexión a la DB falla
  try {
    // La línea para nos conecta a la BD
    $pdo = new PDO($dsn, $serveruser, $serverpasswd, $options);

    // Sentencia SQL
    $sql = "INSERT publicaciones() VALUES();";

    // Preparamos
    $stmt = $pdo->prepare($sql);

    // Ejecutamos
    $stmt->execute([$_POST["username"]]);

    echo "Post publicado!";
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
} ?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Creador de posts</title>
</head>

<body>
  <form action="" method="post">
    <textarea name="contenido" id="contenido" required></textarea>
    <button type="submit">Crear post</button>
  </form>


</body>

</html>