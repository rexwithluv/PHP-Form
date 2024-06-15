<?php session_start();
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
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]; ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
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

                    // Damos la bienvenida
                    echo "
                        <h1>¡Bienvenido " . $usuario["nombreCompleto"] . "!</h1>
                        <h3>Ahora mismo tienes " . $usuario["edad"] . " años :)</h3>
                        <a href='create-post.php'>Crear post</a>
                        <a href='edit-post.php'>Editar post</a>
                        <a href='remove-post.php'>Eliminar post</a>
                        <hr/>";

                    // Sentencia SQL para los últimos 10 posts de la BD
                    $sql = "SELECT
                            u.username, p.fechaPublicacion, p.contenido
                        FROM
                            publicaciones AS p
                                INNER JOIN
                            usuarios AS u ON p.userID = u.ID
                        ORDER BY p.fechaPublicacion DESC
                        LIMIT 10;";

                    // Preparamos
                    $stmt = $pdo->prepare($sql);

                    // Ejecutamos
                    $stmt->execute();

                    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    print_r($posts);
                }
            } else {
                echo "<h1>No he podido verificar tus datos, lo siento :(</h1>";
            }
        } else {
            echo "
                <div class='centered-container'>
                    <div class='container'>
                        <div class='row justify-content-center'>
                            <div class='col-md-4'>
                                <div class='border p-4 rounded'><h2 class='text-center'>Iniciar Sesión</h2>
                                    <form action='' method='post'>
                                        <div class='mb-3'>
                                            <label for='username' class='form-label'>Usuario</label>
                                            <input type='text' class='form-control' name='username' id='username' placeholder='Ingrese su usuario' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='passwd' class='form-label'>Contraseña</label>
                                            <input type='password' class='form-control' name='password' id='password' placeholder='Ingrese su contraseña' required />
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Iniciar Sesión</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
        }
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    } ?>
</body>

</html>