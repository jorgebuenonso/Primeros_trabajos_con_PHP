<?php
require_once("../modelo/session.php");
require_once("../modelo/control.php");
require_once("../controlador/controller.php");

if(isset($_SESSION['err'])){
    echo "<script>alert('" .$_SESSION['err'] ."')</script> ";
    unset($_SESSION['err']);
}

$p  = new Modelo();

if (empty($pagina)) {

    $p->paguinacion($tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleNew.css">

    <title>Vivienda</title>
    <style>
        body {
            background-image: url(https://inmobiliariaham.es/wp-content/uploads/2021/08/Logo-HAM.svg);
            background-repeat: no-repeat;
            /* background-repeat: initial; */
            background-position: 150px 32px;
        }
    </style>

</head>

<body>

    <div class="col-xs-12">
        <h2>Viviendas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Tipo</td>
                    <td>Zona</td>
                    <td>DIRECCIÓN</td>
                    <td>DORMITORIOS</td>
                    <td>PRECIO</td>
                    <td>TAMAÑO</td>
                    <td>FOTO</td>
                    <td>FECHA ANUNCIO</td>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($dato)) :
                    foreach ($dato as $key => $value)
                        foreach ($value as $v) :
                            $fotos = explode(',', $v['nombres_fotos']);

                ?>
                        <tr>
                            <td><?php echo $v['id'] ?> </td>
                            <td><?php echo $v['tipo'] ?> </td>
                            <td><?php echo $v['zona'] ?> </td>
                            <td><?php echo $v['direccion'] ?> </td>
                            <td><?php echo $v['ndormitorios'] ?> </td>
                            <td><?php echo $v['precio'] ?> </td>
                            <td><?php echo $v['tamano'] ?> </td>

                            <!-- // Muestra el enlace de cada foto individualmente -->
                            <td>
                                <?php foreach ($fotos as $foto) { ?>
                                    <a href="../fotos/<?php echo $foto; ?>"><?php echo $foto; ?></a><br>
                                <?php } ?>
                            </td>

                            <td><?php echo $v['fecha_anuncio'] ?> </td>
                            <td>
                                <a class="btn" href="../controlador/controller.php?m=editar&id=<?php echo $v['id'] ?>">EDITAR</a>
                                <a class="btn" href="../controlador/controller.php?m=eliminarV&id=<?php echo $v['id'] ?>" onclick="return confirm('ESTA SEGURO'); false">ELIMINAR</a>
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

                    <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> Viviendas disponibles</p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                </div>
            </div>
            <ul class="pagination">
                <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a href="../vista/indexVista.php?pagina=<?php echo $pagina - 1 ?>">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo "active" ?>">
                        <a href="../vista/indexVista.php?pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                <?php if ($pagina < $paginas) { ?>
                    <li>
                        <a href="../vista/IndexVista.php?pagina=<?php echo $pagina + 1 ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <nav class="navNewUsuario">
        <a href='../controlador/controller.php?m=nuevaVivienda' class='newUsuario'>Nuevo Anuncio</a>
        <a href='../controlador/controller.php?m=buscar' class='newUsuario'>Buscar Vivienda</a>
        <?php if (!empty($_SESSION['id'])) {
            if ($_SESSION['id'] == "admin") {?>
            <a class='newUsuario' href='../controlador/controller.php?m=usuarios'>Usuarios</a>
        <?php } ?>
        <?php } ?>
    </nav>

</body>

</html>