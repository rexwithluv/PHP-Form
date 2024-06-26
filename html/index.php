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

if (isset($_SESSION["userID"])){
    header("Location: welcome.php");
}
?>


<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <link rel="stylesheet" href="index.css" />
    <title>Login</title>
</head>

<body>
    <?php
    // Si la conexión a la DB falla
    try {
        // La línea para nos conecta a la BD
        $pdo = new PDO($dsn, $serveruser, $serverpasswd, $options);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sentencia SQL
            $sql = "SELECT
                    ID,
                    nombreCompleto,
                    TRUNCATE(DATEDIFF(CURDATE(), fechaNacimiento) / 365, 0) AS edad,
                    password
                FROM
                    usuarios
                WHERE
                    username = ?;";

            // Preparamos
            $stmt = $pdo->prepare($sql);

            // Ejecutamos
            $stmt->execute([$_POST["username"]]);

            // $usuario almacenará el resultado en un array
            $usuario = $stmt->fetch();

            // Si el usuario es false quiere decir que la consulta no devolvió nada :)
            if ($usuario !== false) {
                // Comprobamos si la contraseña es correcta
                if ($usuario["password"] === $_POST["password"]) {

                    // Guardamos datos de la sesión
                    $_SESSION["userID"] = $usuario["ID"];
                    $_SESSION["userNombreCompleto"] = $usuario["nombreCompleto"];
                    $_SESSION["userEdad"] = $usuario["edad"];

                    // Redireccionamos usando JS
                    echo '<script> window.location.replace("welcome.php"); </script>';
                }
            } else { ?>
                <div class="hero is-fullheight">
                    <div class="hero-body has-text-centered">
                        <div class="container">
                            <h1 class="title is-1">No he podido verificar tus datos, lo siento :(</h1>
                            <a class="button is-dark" href="index.php">Volver al inicio</a>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            ?>
            <div class="block">
                <div class="hero is-link">
                    <div class="hero-body has-text-centered">
                        <h2 class="title is-2">Bienvenido al formulario de login.</h2>
                        <h4 class="title is-4">Por favor, rellena los campos.</h4>
                    </div>
                </div>
            </div>


            <div class="block">
                <div class="fixed-grid has-3-cols">
                    <div class="grid">
                        <div class="cell is-col-start-2 box">
                            <h2 class="title is-2 has-text-centered">Iniciar sesión</h2>
                            <form action="" method="post">

                                <div class="field">
                                    <label class="label" for="username">Usuario</label>
                                    <div class="control has-icon-left">
                                        <input class="input" type="text" name="username" id="username" placeholder="Ingrese su usuario" required />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="passwd">Contraseña</label>
                                    <div class="control has-icon-left">
                                        <input class="input" type="password" name="password" id="password" placeholder="Ingrese su contraseña" required />
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field has-text-centered">
                                    <div class="control">
                                        <button type="submit" class="button is-link has-text-centered">Iniciar Sesión</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    } ?>
</body>

</html>