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

    //Conexion correcta
    include_once 'conexion.php';

    if(isset($_POST['guardar'])){
        $nombre= $_POST['nombre'];
        $email= $_POST['email'];
        $mensaje= $_POST['mensaje'];

        if(!empty($nombre) && !empty($email) && !empty($mensaje) ){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<script> alert('Correo no válido');</script>";
            }else{
                $consulta_insert= $con->prepare('INSERT INTO registro(nombre, email, mensaje) VALUES (:nombre,:email,:mensaje)');
                $consulta_insert->execute(array(
                    ':nombre' =>$nombre,
                    ':email' =>$email,
                    ':mensaje' =>$mensaje
                ));
                header('Location: admin.php');
            }
        }else{
            echo "<script> alert('Los campos están vacíos');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Contacto</title>
    <link rel=stylesheet href="css/estilo.css">
</head>
<body>
<div class="contenedor">
    <h2>Panel de Administrador</h2>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" class="input__text">
            <input type="text" name="email" placeholder="Correo" class="input__text">
        </div>
        <div class="form-group">
            <input type="text" name="mensaje" placeholder="Mensaje" class="input__text">
        </div>
        <div class="btn__group">
            <a href="index.php" class="btn btn__danger">Cancelar</a>
            <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
        </div>  
    </form>
</div>
    
</body>
</html>