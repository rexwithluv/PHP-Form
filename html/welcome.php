<?php session_start();
// Datos para la conexión a la BD
$host = "172.20.0.2";
$dbname = "PHPFormBD";
$serveruser = "admin";
$serverpasswd = "abc123.";
$charset = "utf8mb4";

// Sentencia para conectarnos a la BD
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Opciones para la BD
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Si el usuario no ha iniciado sesión lo redirige al index.php
if (!isset($_SESSION["userID"])) {
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="welcome.css">
    <title>Bienvenido</title>
</head>

<body>
    <?php
    try {
        $pdo = new PDO($dsn, $serveruser, $serverpasswd, $options);
    ?>
        <div class="hero is-link ">
            <div class="hero-body">
                <div class="has-text-centered">
                    <h1 class="title is-1">¡Bienvenido <?php echo $_SESSION["userNombreCompleto"] ?>!</h1>
                    <h3 class="title is-3">Ahora mismo tienes <?php echo $_SESSION["userEdad"] ?> años :&#41;</h3>
                </div>
            </div>
                <div class="hero-body">
                    <div class="columns is-centered">
                        <a class="column is-2 button is-medium" href="create-post.php">Crear posts</a>
                        <a class="column is-2 button is-medium" href="edit-post.php">Editar posts</a>
                        <a class="column is-2 button is-medium" href="remove-post.php">Eliminar posts</a>
                    </div>
                    <div class="columns is-centered">
                        <a href="logout.php" class=" column is-1 is-danger button">Cerrar sesión</a>
                    </div>
                </div>

        </div>

        <?php
        // Sentencia SQL para los últimos 10 posts de la BD
        $sql = "SELECT
            u.nombreCompleto, u.username, p.fechaPublicacion, p.contenido
        FROM
            publicaciones AS p
                INNER JOIN
            usuarios AS u ON p.userID = u.ID
        ORDER BY p.fechaPublicacion DESC
        LIMIT 9;";

        // Preparamos
        $stmt = $pdo->prepare($sql);

        // Ejecutamos
        $stmt->execute();

        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <!-- HTML y PHP for-each para desplegar tarjetas con los últimos 9 posts -->
        <div class="columns is-multiline columns-posts">
            <?php foreach ($posts as $post) { ?>
                <div class="column is-one-third">
                    <div class="card">
                        <div class="card-content">
                            <div class="media-content">
                                <h4 class="title is-4"><?php echo $post["nombreCompleto"] ?></h4>
                                <h6 class="subtitle is-6"><?php echo "@" . $post["username"] ?></h6>
                                <div class="content"> <?php echo htmlspecialchars($post["contenido"], ENT_QUOTES)  ?></div>
                                <div class="content date-align-right">
                                    <?php $fechaPublicacion = new DateTime($post["fechaPublicacion"]);
                                        echo $fechaPublicacion->format("d/m/Y H:i") ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    ?>
</body>

</html>