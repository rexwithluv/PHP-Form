<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>

<body>
    <?php
    // Datos para la conexión a la BD
    $host = "172.20.0.2";
    $dbname = "albertoBD";
    $serveruser = "admin";
    $serverpasswd = "abc123.";
    $charset = "utf8mb4";

    // Sentencia para conectarnos a la BD
    $dsn = "mysql:host=$host;$dbname=$dbname;charset=$charset";

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sentencia SQL
            $sql = "SELECT nombreCompleto, TRUNCATE(datediff(curdate(), fechaNacimiento)/365, 0) AS edad, password FROM usuarios WHERE username = ?";

            // Preparamos
            $stmt = $pdo->prepare($sql);

            // Ejecutamos
            $stmt->execute([$_POST["username"]]);

            // $usuario almacenará el resultado en un array
            $usuario = $stmt->fetch();

            // Comprobamos si la contraseña es correcta
            if ($usuario["password"] === $_POST["password"] and count($usuario) > 0) {
                echo "<h1>¡Bienvenido " . $usuario["nombreCompleto"] . "!</h1>";
                echo "<h3>Ahora mismo tienes " . $usuario["edad"]  . " años :)</h3>";
            } else {
                echo "<h1>No he podido verificar tus datos, lo siento :(</h1>";
            }
        } else {
            echo "<h1>No deberías estar aquí sin pasar por el formulario</h1>";
        }
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    } ?>
</body>

</html>