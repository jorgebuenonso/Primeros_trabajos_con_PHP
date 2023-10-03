<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleNew.css">
    <title>Insertar</title>
   
</style>
</head>
<body class="bodyNewUsuario">
    <a class='volver' href='../controlador/controller.php?m=usuarios'class='btn'>VOLVER</a>
    <h1 class="text-center">NUEVO USUARIO</h1>
    <form class="formNuevoU" method="get">
      
        <input type="text" placeholder="Ingrese id_usuario:" name="id" maxlength="9" required> <br>
        <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>
        <input type="hidden" name="m" value="guardarusuario">  
    </form>

</body>
</html>