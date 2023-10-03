<?php
require_once("../modelo/session.php");
require_once("../modelo/control.php");
require_once("../controlador/controller.php");

$cone = new Conexion;
$conn = $cone->control();
$p  = new Modelo();

if (empty($pagina)) {

    $p->paguinacion($tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
}

if (isset($_REQUEST['pass'])) {
    echo "<script> alert('Tu contraseña es " . $_REQUEST['pass'] . " Guardela bien'); </script>";
    unset($_REQUEST['pass']);
}
 if(isset($_REQUEST['error'])) {
    echo "<script> alert('No se realizo la operación, el usuario ya se encuentra dado de alta'); </script>";
}

echo "<a class='volver' href='../controlador/controller.php?m=viviendas'class='btn'>VOLVER</a>";

if (!empty($_SESSION['id'])) {
    if ($_SESSION['id'] != "admin") {
        header("Location: ../controlador/controller.php?m=viviendas");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleNew.css">

    <title>usuarios</title>

    <style>
        body {
            background-image: url(https://inmobiliariaham.es/wp-content/uploads/2021/08/Logo-HAM.svg);
            background-repeat: no-repeat;
            /* background-repeat: initial; */
            background-position: 150px 32px;
        }
    </style>
</head>

<body class="bodyVistaUsuario">

    <div class="col-xs-12">
        <h2 class="tituloU">Usuarios</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>PASSWORD</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($dato)) :
                    foreach ($dato as $key => $value)
                        foreach ($value as $v) : ?>

                        <tr>
                            <td><?php echo $v['id_usuario'] ?> </td>
                            <td><?php echo $v['password'] ?> </td>

                            <!-- // Muestra el enlace de cada foto individualmente -->
                            <td>
                                <?php if($v['id_usuario']!="admin"){ ?>
                                    <a class="btn" href="../controlador/controller.php?m=eliminarU&id=<?php echo $v['id_usuario'] ?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
                               <?php } ?>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">NO HAY REGISTROS</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
        <nav>

            <div class="row">
                <div class="col-xs-12 col-sm-6">

                    <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> usuarios</p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                </div>
            </div>
            <ul class="pagination">
                <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a href="../controlador/controller.php?m=usuarios&pagina=<?php echo $pagina - 1 ?>">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo "active" ?>">
                        <a href="../controlador/controller.php?m=usuarios&pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                <?php if ($pagina < $paginas) { ?>
                    <li>
                        <a href="../controlador/controller.php?m=usuarios&pagina=<?php echo $pagina + 1 ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

        <nav class="navNewUsuario">
            <a href='../controlador/controller.php?m=nuevoUsuario' class='newUsuario'>Nuevo usuario</a>

        </nav>
    </div>


</body>

</html>