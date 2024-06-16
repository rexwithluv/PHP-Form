<?php
session_start();

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
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
  <title>Creador de posts</title>
</head>

<body>
  <form action="" method="post">
    <textarea name="contenido" id="contenido" required></textarea>
    <button type="submit">Crear post</button>
  </form>

  <?php
  // Si la conexión a la DB falla
  try {
    // La línea para nos conecta a la BD
    $pdo = new PDO($dsn, $serveruser, $serverpasswd, $options);

    // Ejecutará todo cuando lance el formulario, es decir, cuando quiera publicar
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Sentencia SQL
      $sql = "INSERT publicaciones(userID, fechaPublicacion, contenido) VALUES (?, NOW(), ?)";

      // Preparamos
      $stmt = $pdo->prepare($sql);

      // Ejecutamos
      $stmt->execute([$_SESSION["userID"], $_POST["contenido"]]);

      echo "Post publicado!";
    }
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
  ?>
</body>

</html>