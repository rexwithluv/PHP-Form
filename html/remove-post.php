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

if (!isset($_SESSION["userID"])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Eliminar post</title>
</head>

<body>
    <div class="block">
        <div class="hero is-link">
            <div class="hero-body has-text-centered">
                <h2 class="title is-2">Bienvenido al borrador de post.</h2>
                <h4 class="title is-4">Por favor, rellena los campos.</h4>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="fixed-grid has-3-cols">
            <vid class="grid">
                <div class="cell is-col-start-2 box">
                    <h2 class="title is-2 has-text-centered">
                        Dime el ID del post a eliminar
                    </h2>
                    <form action="" method="post">
                        <div class="field">
                            <label for="postID" class="label">ID</label>
                            <div class="control">
                                <input type="text" class="input" placeholder="ID">
                            </div>
                        </div>

                        <div class="field has-text-centered">
                            <div class="control">
                                <button class="button is-medium is-danger">Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </vid>
        </div>
    </div>



</body>

</html>