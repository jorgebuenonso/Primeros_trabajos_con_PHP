<!DOCTYPE html>
<?php
require_once "./controlador/controlUsuario.php";

?>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<h1 class="title-login">INGRESO EN TIENDA</h1>
	<div class="container-login">
		<form class="form-login" action="" method="post">
			<fieldset>
				<legend>Datos de acceso</legend>
				Usuario: <input type="text" name="email" id="email" value="<?php echo isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : ''; ?>" />
				<br /><br />
				Contrasena: <input type="password" name="contrasena" id="contrasena" value="<?php echo isset($_COOKIE['contrasena']) ? $_COOKIE['contrasena'] : ''; ?>" />
				<br /><br />
				<label for="recordar">Recordar contraseña:</label>
				<input type="checkbox" name="recordar" id="recordar" />
				<br /><br />
				<input type="submit" name="enviar" id="enviar" value="Iniciar sesión" />
				<br /><br />
				<input type="submit" name="registro" id="registro" value="Registrate" />
			</fieldset>
		</form>
	</div>
</body>

</html>