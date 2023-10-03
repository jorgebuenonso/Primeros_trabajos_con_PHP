<?php
// Hacemos el metodo REQUEST que es el que va a hacer la consulta y devolverá los datos --> el $_GET del form y procesarlo
// Este sería mi servidor interno (consulto si existe ese dato en la BD)
// Esto seria la puerta al servidor.
include "../MODELO/UsuarioDAO.php";

$conn = new UsuarioDAO();

if($_SERVER['REQUEST_METHOD'] == 'GET'){ // Si hay recursos...
    // if(isset($_REQUEST["email"])){
        $email=$_REQUEST["email"]??"";
        /*Comprobamos con una consulta si el valor del email esta en la BD para extraer el dato*/
        $sql = $conn->conexion()->prepare("SELECT * FROM USUARIO WHERE Email='".$email."'");
        //  $sql->bindValue(':email', "'.$_GET['email'].");
        $sql->execute();
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
        exit();
//     }
 }




?>