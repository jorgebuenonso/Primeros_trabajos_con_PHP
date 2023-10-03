<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .container {
      display: flex;
      justify-content: flex-end;
      align-items: flex-end;
      height: 100%;
    }

    .content {
      padding: 20px;
      background-color: #f2f2f2;
    }
</style>
</head>
<body>

<div class="container">
  <div class="content">
  <?php

 session_start();

$current_time = time();
 if(empty($_SESSION['id'])){
   header('Location: /inmobiliaria/');
 }else{
    echo "Bienvenido ". $_SESSION['id'] ."<br>";
    echo "<a href='..//modelo/logout.php'>Cerrar sessión</a>";
// Comprueba si existe una cookie con la información de última conexión
if (isset($_COOKIE['last_login'])) {
  // Lee la fecha y hora guardadas en la cookie
  $last_login = $_COOKIE['last_login'];
  // Muestra la última conexión del usuario
  echo " Su última conexión fue el " . date('d/m/Y H:i:s', $last_login);
}
// Actualiza la información de la cookie con la fecha y hora actual
setcookie('last_login', $current_time, time() + (30 * 24 * 60 * 60));
 }

?>
  </div>
</div>

  
</body>
</html>

