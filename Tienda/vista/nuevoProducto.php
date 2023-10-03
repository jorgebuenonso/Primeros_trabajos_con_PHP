<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <a class='volver' href=' ../vista/indexvista.php' class='btn'>VOLVER</a>
    
        <h3 class="newP">NUEVO PRODUCTO</h3>
        <div class="container-new-producto">
            <form class="form-new-producto" action="../controlador/controller.php" method="post">

                <!-- codProd:<input type="text" name="cod" require><br><br> -->
                Nombre:<input type="text" name="nombre" require><br><br>
                PVP:<input type="number" name="pvp" step="any" required><br><br>
                Descripción<input type="text" name="des" require><br><br>

                <br><br>
                <input type="hidden" name="m" value="guardarProducto">
                <input type="submit" class="btn" name="btn" value="GUARDAR"> <br>

            </form>
        </div>
    
</body>

</html>