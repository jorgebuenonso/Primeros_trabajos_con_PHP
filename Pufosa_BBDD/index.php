<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <div class="body"></div>
  <div class="grad"></div>
  <div class="header">
    <div class="name_login">Acesso<span>BBDD</span></div>
  </div>
  <br>
  <form action="" method="post">
    <div class="login">
      <input type="text" id="usuario" placeholder="usuario" name="usuario" required><br>
      <input type="password" placeholder="contraseña" name="contrasena" required><br>
      <input type="submit" name="botonEnvia" value="Entrar">
    </div>
  </form>
  </div>
  </div>

  <?php
  include_once 'control.php';

  // recojo informacion de acceso del usuario y lo cotejo con la BBDD, si el acceso es correcto creo una sesion con su cargo en la empresa para configurar su tipo de acceso

  if (isset($_POST["contrasena"])) {
    $sql = "SELECT * FROM EMPLEADOS WHERE EMPLEADO_ID = :nom;";
    $stmt = $conn->prepare($sql);
    $id = $_POST["usuario"];
    $passwd = strtoupper($_POST["contrasena"]);
    $stmt->bindParam(':nom', $id);
    $stmt->execute();

    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
    // pongo en mayusculas tanto lo que introduce el usuario como lo que puede contener la BBDd para evitar errores y asegurar el cotejamiento
    $nombreEInicialMayusculas = strtoupper($registro['Nombre']) . strtoupper($registro['Inicial_del_segundo_apellido']);

    if ($registro) {
        session_start();

        if ($registro['Trabajo_ID'] == 672) {
            $_SESSION['cargo'] = 'presidente';
        } elseif ($registro['Trabajo_ID'] == 671) {
            $_SESSION['cargo'] = 'manager';
        } else {
            $_SESSION['cargo'] = 'otros';
        }
        
       
            if ($nombreEInicialMayusculas === $passwd) {
            $nombreUsuario = $registro['Nombre'] . " " . $registro['Apellido'];
            setcookie("nombre_usuario", $nombreUsuario, time() + 3600, "/");
              header("location:consulta.php");
            } else {
              header("location:index.php");
            }
        } else {
        echo "<script>alert('Usuario no encontrado en la BBDD');</script>";
    }
    }
$conn = null;

  ?>



</body>

</html>