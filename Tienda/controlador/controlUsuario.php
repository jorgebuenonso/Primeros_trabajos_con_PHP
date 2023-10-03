<?php
 require_once 'modelo/usuarioDAO.php';
    
    session_start();
    if(!empty($_COOKIE['valido'])){
        echo $_COOKIE['valido'];
        echo "ok";
    }

    if(isset($_REQUEST['enviar'])){
        $usuario = $_REQUEST['email'];
        $contrasena = $_REQUEST['contrasena'];

        if (isset($_POST['recordar'])) {
            // Establecer una cookie para recordar el usuario y contraseña por 30 días
            setcookie('usuario', $usuario, time() + (30 * 24 * 60 * 60));
            setcookie('contrasena', $contrasena, time() + (30 * 24 * 60 * 60));
        }else {
            // Eliminar las cookies si no se seleccionó "recordar contraseña"
            setcookie('usuario', '', time() - 3600);
            setcookie('contrasena', '', time() - 3600);
        }
        // require_once(__DIR__.'/modelo/usuarioDAO.php');
        $dao= new usuarioDAO();

       $result= $dao->validarAcceso($usuario,$contrasena);
        print_r($result);
    //    En PHP, puedes comprobar si una variable contiene un string utilizando la función is_string().
    //     Esta función devuelve true si la variable es un string y false en caso contrario.

       if(is_String($result)){
        $_SESSION['usuario']= $result;
         header("Location: ./controlador/controller.php");
       }else if($result==0){
        echo "Password mal introducido";
       }else if($result==2){
        echo "Nombre mal introducido";
       }else{
        echo "Rellene los campos";
       }
      
    }

    if(isset($_REQUEST['registro'])){
        $_SESSION['usuario']= "invitado";
        header("Location: ./controlador/controller.php?m=nuevoUsuario"); 
    }
    // require_once "../vista/login.php";

?>
