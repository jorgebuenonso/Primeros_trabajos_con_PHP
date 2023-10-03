<?php
require_once("../modelo/session.php");
require_once("../modelo/vivienda.php");

if(isset($_SESSION['err'])){
    echo "<script>alert('" .$_SESSION['err'] ."')</script> ";
    unset($_SESSION['err']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleNew.css">
    <title>viviendas</title>

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
    <a class='volver' href='../controlador/controller.php?m=viviendas' class='btn'>VOLVER</a>

    <!-- muestro el listado de la busqueda del usuario -->
    <div class="col-xs-12">
        <h2>Viviendas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>TIPO</td>
                    <td>ZONA</td>
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
                if (!empty($datos)) :
                    foreach ($datos as $key => $value)
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
                    <script>
                        alert("No hay registros")
                    </script>
                    <tr>
                        <td colspan="3">NO HAY REGISTROS</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>

        <nav class="navNewUsuario">
            <a href='../controlador/controller.php?m=nuevaVivienda' class='newUsuario'>Nuevo Anuncio</a>
            <a href='../controlador/controller.php?m=buscar' class='newUsuario'>Buscar Vivienda</a>

        </nav>

</body>

</html>