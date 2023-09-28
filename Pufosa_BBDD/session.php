<?php

 session_start();

$current_time = time();
 if(empty($_SESSION['cargo'])){
    header("location:index.php");
 }elseif (isset($_COOKIE['nombre_usuario'])){
   echo "<div style='color:#BFBFBF'>Bienvenido ". $_COOKIE['nombre_usuario'] ."</div></br>";

    
// Comprueba si existe una cookie con la información de última conexión
if (isset($_COOKIE['last_login'])) {
  // Lee la fecha y hora guardadas en la cookie
  $last_login = $_COOKIE['last_login'];
  // Muestra la última conexión del usuario
  echo "<div style='color:#BFBFBF'> Su última conexión fue el " . date('d/m/Y H:i:s', $last_login) . "</div>";

}
// Actualiza la información de la cookie con la fecha y hora actual
setcookie('last_login', $current_time, time() + (30 * 24 * 60 * 60));
 }
