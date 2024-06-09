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
    $servername = "172.20.0.2";
    $serveruser = "admin";
    $serverpasswd = "abc123.";
    $database = "albertoBD";

    // Conexión en sí a la DB
    $conn = new mysqli($servername, $serveruser, $serverpasswd, $database);

    // Si la conexión a la DB falla
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Preparamos la sentencia
        // Sentencia SQL
        $sql = "SELECT nombreCompleto, TRUNCATE(datediff(curdate(), fechaNac)/365, 0) AS edad, passwd FROM usuarios WHERE username = ?";

        // Preparamos
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_POST["username"]);

        // Ejecutamos la consulta y almacenamos el resultado en una variable
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Usuario almacenará el resultado en un array
        $usuario = $resultado->fetch_assoc();

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

    // Cerramos la conexión
    $conn->close();
    ?>
</body>

</html>