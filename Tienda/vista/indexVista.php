<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php require_once("../modelo/session.php");
    require_once("../modelo/dataSource.php");
    // require_once("../controlador/controller.php") ?>

    <br><br>
    <form class="option" action="../controlador/controller.php" method="get">
        <input type="submit" value="Producto Nuevo">
        <input type="hidden" name="m" value="nuevoProducto">
    </form>
    <h2>Productos</h2>
    <?php
    //paginacion

    // en la segunda recarga conn pierde conexion
    $data = new DataSource('producto');

    if (empty($pagina)) {

        $conn = $data->conexion();

        $data->paguinacion($tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
    }
    // Obtener los nombres de los campos
    $resultadoCampos = $conn->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='tienda' AND `TABLE_NAME`='producto';")->fetchAll();
    $campos = array_column($resultadoCampos, 'COLUMN_NAME');

    // Mostrar la tabla
    echo "<form method='post'><div class='col-xs-12'><table border='1'><thead><tr>";

    // Mostrar los encabezados de la tabla con los nombres de los campos
    foreach ($campos as $campo) {
        echo "<th>" . $campo . "</th>";
    }
    echo "<th>Añadir</th><th>Borrar</th><th>Modificar</th></tr></thead><tbody>";

    if (!empty($dato)) :

        foreach ($dato as $key) :
            foreach ($key as $v) :
                echo "<tr>";
                // Mostrar los valores de cada campo
                foreach ($campos as $campo) {
                    echo "<td>" . $v[$campo] . "</td>";
                }
                echo "<td>";
                echo "<form method='post'>";
                echo '<input type="hidden" name="producto[' . $v['Nombre'] . ']" value="' . $v['PVP'] . '">';
                echo "<button type='submit' value='' name='agregar'>Añadir</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo '<input type="hidden" name="cod" value="' . $v['codProd'] . '">';
                echo "<button type='submit' value='' name='borrarT'>Borrar</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post'>";
                echo '<input type="hidden" name="codP" value="' . $v['codProd'] . '">';
                echo "<button type='submit' value='' name='modificar'>Modificar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            endforeach;
        endforeach;

        echo "</tbody></table></div>";
    else :
    ?>
        <tr>
            <td colspan="5">NO HAY REGISTROS</td>
        </tr>
    <?php
    endif;
    ?>
    <nav>

        <div class="row">
            <div class="col-xs-12 col-sm-6">

                <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> productos disponibles</p>
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
        <?php

        require_once "../controlador/carrito.php";
        if (!empty($_SESSION['carro'])) {
        ?>

            <h2>Carrito</h2>

            <table border="1">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Borrar</th>
                </tr>
                <?php

                foreach ($_SESSION['carro'] as $producto => $valor) {
                    $plato = $producto ?? "";
                    $precio_total += $valor['precio'];

                ?>

                    <tr>
                        <td><?php echo $producto; ?></td>
                        <td><?php echo $valor['cantidad']; ?></td>
                        <td><?php echo $valor['precio']; ?></td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='producto[<?php echo $producto; ?>]' value='<?php echo $precio; ?>'>
                                <button type="submit" value="" name="borrar">Borrar</button>
                            </form>
                        </td>
                    </tr>
            <?php }?>

            
                    </table>
                    <form class="option" method='post'>
                        <input type='submit' name='vaciar' value='Vaciar carrito'>
                        <input type='submit' name='finalizar' value='Finalizar compra'>
                    </form>
                    </table>
            <?php } ?>


            <?php
            if (isset($_REQUEST['finalizar'])) {

                echo "<p><b>Precio Total </b> " . $precio_total . "</p>";
                  
            }

            ?>



</body>
</body>

</html>