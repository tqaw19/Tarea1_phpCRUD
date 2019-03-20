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
    if(isset($_GET['id'])){
        $id=(int) $_GET['id'];
        $delete= $con->prepare('DELETE FROM registro WHERE id=:id');
        $delete->execute(array(
            'id' => $id
        ));
        header('Location: admin.php');
    }else{
        header('Location: admin.php');
    }
?>