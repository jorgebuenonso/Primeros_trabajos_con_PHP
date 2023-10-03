<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Insertar</title>

    </style>
</head>

<body>
    <a  class='volver' href='Tienda' class='btn'>VOLVER</a>
    <h1>NUEVO USUARIO</h1>
    <div class="container-ingreso">
        <form class="form-ingreso" action="" method="get">

            Nombre: <input type="text" name="nombre" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required><br><br>
            Apellidos: <input type="text" name="ape" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios" required><br><br>
            Domicilio: <input type="text" name="domi" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ]+[\d\s]*" title="Cadena de texto" required><br><br>
            Número de télefono: <input type="tel" name="num" pattern="[0-9]+" title="Solo se permiten números" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Password: <input type="password" name="pass"><br><br>
            Confirmar Password: <input type="password" name="confiPass" required><br><br>
            <input type="hidden" name="m" value="guardarUsuario">
            <input type="submit" class="btn" name="btn" value="GUARDAR"><br>

        </form>
    </div>
</body>

</html>