<?php
    //Seguridad
    $valid_passwords = array ("alejandro" => "wilson123");
    $valid_users = array_keys($valid_passwords);

    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];

    $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

    if (!$validated) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Not authorized");
    }

    // If arrives here, is a valid user.
    echo "<div class='btn__update'>Bienvenido $user.</div>";

    //Conexión correcta
    include_once 'conexion.php';

    $sentencia_select = $con->prepare('SELECT * FROM registro ORDER BY id DESC');
    $sentencia_select->execute();
    $resultado = $sentencia_select->fetchAll();



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard</title>
    <link rel=stylesheet href="css/estilo.css">
</head>
<body>
    <div class=contenedor>
        <h2>Panel de Administrador</h2>
        <div class="barra__buscador">
        </div>
        <table>
            <tr class="head">
                <td>Id</td>
                <td>nombre</td>
                <td>Email</td>
                <td>Mensaje</td>
                <td colspan="2">Acción</td>
            </tr>
            <?php foreach($resultado as $fila):?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['mensaje']; ?></td>
                <td><a href="update.php?id=<?php echo $fila['id']; ?>" class="btn__update">Editar</a></td>
                <td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>