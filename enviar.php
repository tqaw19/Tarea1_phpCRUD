<?php
          $name = $_POST['nombre'];
          $email = $_POST['email'];
          $msn = $_POST['mensaje'];
          
        echo $name;
        echo $email;
        echo $msn;
        
   		email($email,"Contacto",$msn,$name);
		
?>