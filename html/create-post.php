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
<html lang="es" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
  <title>Creador de posts</title>
</head>

<body>

  <div class="block">
    <div class="hero is-link">
      <div class="hero-body has-text-centered">
        <h2 class="title is-2">Bienvenido al creador de post.</h2>
        <h4 class="title is-4">Por favor, rellena los campos.</h4>
      </div>
    </div>
  </div>

  <div class="block">
    <div class="fixed-grid has-3-cols">
      <div class="grid">
        <div class="cell is-col-start-2 box">
          <h2 class="title is-2 has-text-centered">
            <span class="icon-text">
              <i class="fas fa-arrow-down"></i>
            </span>
            Introduce aquí tus pensamientos
          </h2>
          <form action="" method="post">
            <div class="field">
              <div class="control">
                <textarea name="contenido" id="contenido" class="textarea" required></textarea>
              </div>
            </div>

            <div class="field has-text-centered">
              <div class="control">
                <button type="submit" class="button is-medium">Publicar</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


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
  ?>
      <script>
        alert("Post publicado!");
        window.location.replace("welcome.php");
      </script>
  <?php
    }
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
  ?>
</body>

</html>