<?php
        $servidor= "localhost";
        $usuario ="root";
        $clave = "";
        $sql = "";
        $BBDD = "pufosa2";

        try{
            $conn = new PDO("mysql:host=$servidor;dbname=$BBDD;charset=utf8", $usuario, $clave);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        }
        catch(PDOException $e){
            
            echo "<script>alert('ERROR: FALLO EN LA CONEXIÓN CON LA BBDD: " . $e->getMessage() . "');</script>";
        
        }
        
        return $conn; // realizo conexión y retorno.

       
    ?>