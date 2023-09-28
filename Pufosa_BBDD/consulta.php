<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link rel="stylesheet" href="./css/styleConsulta.css">
</head>

<body>
    <?php include_once("session.php");
    include_once("navegador.php")
    ?>


    <div class="consulta">

        <div class="consulta-screen">
            <div class="app-title">
                <!-- <h1>Consulta general</h1> -->
            </div>

            <div class="consulta-form">
                <h4 class="titulo-consulta">Consultar</h4>
                <h4 class="titulo-tabla">Tabla</h4>
                <form class="control-group" action="" method="post">
    
                    <?php if ($_SESSION['cargo'] == 'presidente' || $_SESSION['cargo'] == 'manager') {?>
                        <select name='opcion2'> <option value='cliente' >Cliente</option>
                            <option value='departamento'>Departamento</option>
                            <option value='empleados' >Empleados</option>
                            <option value='trabajos' >Trabajos</option>
                            <option value='ubicacion' >Ubicación</option></select>
                            <input class="comprobar" type="submit" name="botonEnvia2" value="Buscar">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once 'control.php';
    // $condicion = "";

    if (empty($_REQUEST['opcion2'])) {
        $tabla = "cliente";
    } else {
        $tabla = $_REQUEST['opcion2'];
    }

    $sql = "SELECT * FROM $tabla";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $registrosPorPagina = 5; // Número de registros por página
    $paginas = array_chunk($registros, $registrosPorPagina);
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    echo "<h2 class='consulta'>Listado de $tabla</h2>";
    echo "<a href='insertar.php?tabla=" . $tabla . "' class='boton-enlace'>Insertar nuevo registro en " . $tabla . "</a>";




    if (count($registros) > 0) {
        echo "<table border='1'>";
        // Imprimir la cabecera de la tabla utilizando las claves del primer registro
        echo "<tr>";
        $campos = array();
        foreach ($registros[0] as $clave => $valor) {
            $campos[] = $clave;
            
            echo "<th>$clave</th>";
        }
        echo "<th>Modificar</th>";
        echo "<th>Borrar</th>";
        echo "</tr>";

        // Obtener los registros de la página actual
        $registrosPaginaActual = isset($paginas[$paginaActual - 1]) ? $paginas[$paginaActual - 1] : [];

        // Recorrer los registros de la página actual y crear filas de tabla
        foreach ($registrosPaginaActual as $registro) {
            $primerValor = reset($registro); // Obtiene el primer valor del registro
            echo "<tr>";
            foreach ($registro as $valor) {
                echo "<td>$valor</td>";
            }
            echo "<td><a class='modificar-link' href='modificar.php?id=" . $primerValor . "&tabla=" . $tabla . "'>Modificar</a></td>";
            echo "<td><a class='borrar-link' href='borrar.php?campo=" .$campos[0]. "&id=" . $primerValor . "&tabla=" . $tabla . "' onclick='return confirm(\"¿Estás seguro de que quieres borrar este elemento?\");'>Borrar</a></td>";


            echo "</tr>";
        }
        echo "</table>";

    ?>
    
        <div class="paginacion">
            <?php
            // Comprueba si la página actual es mayor que la cantidad total de páginas
            if ($paginaActual > count($paginas)) {
                header("Location: consulta.php?pagina=1&opcion2=" . $tabla);
                exit(); // Asegura que la redirección se procese y no se siga ejecutando este script
            }

            if ($paginaActual > 1) : ?>
                <a class="pagina" href='consulta.php?pagina=<?php echo ($paginaActual - 1); ?>&opcion2=<?php echo $tabla; ?>'>Anterior</a>
            <?php endif; ?>

            <?php
            for ($i = 1; $i <= count($paginas); $i++) : ?>
                <a class="pagina <?php echo $i == $paginaActual ? 'active' : ''; ?>" href='consulta.php?pagina=<?php echo $i; ?>&opcion2=<?php echo $tabla; ?>'><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($paginaActual < count($paginas)) : ?>
                <a class="pagina" href='consulta.php?pagina=<?php echo ($paginaActual + 1); ?>&opcion2=<?php echo $tabla; ?>'>Siguiente</a>
            <?php endif; ?>
        </div>


    <?php
    } else {
        echo "No se encontraron registros.";
    }
    
    ?>


</body>

</body>

</html>