<?php

if(isset($_REQUEST['enviar'])){
    require_once ("../modelo/usuario.php");
    $login = new usuario(); 
    $r=$login->comprobarPass($_REQUEST['nombre'], $_REQUEST['pass']);
    if($r==0){
        session_start();
        $_SESSION['id']=$_REQUEST['nombre'];
        header("Location: controller.php");
    }else{
       
        header('Location: /inmobiliaria/');
        echo "<script>alert('Usuario o contraseña no validos')</script>";
    }
       
}

require_once "vista/login.html"
?>
