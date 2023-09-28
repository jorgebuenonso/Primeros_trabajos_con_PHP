<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Departamentos</title>
    <link rel="stylesheet" href="./css/styleConsulta.css">
    
</head>
<body>
    <?php

    include_once("session.php");
    include_once("navegador.php");

    if($_SESSION['cargo']=='otros'){
        header("Location:consulta.php");
    }
    ?>

    <h2>Informe de departamentos</h2>
    <!-- consulta de salarios y empleados por departamento -->

    <?php
    include_once 'control.php';

    $registrosPorPagina = 5; // Número de registros por página

    // Consulta SQL sin LIMIT para obtener todos los registros
    $sql = "SELECT departamento.departamento_ID, departamento.Ubicacion_ID, MAX(empleados.Salario) AS 'Salario máximo', MIN(empleados.Salario) AS 'Salario mínimo', AVG(empleados.Salario) AS 'Salario medio', COUNT(empleados.Salario) AS 'Total de trabajadores por departamento' FROM DEPARTAMENTO, EMPLEADOS WHERE departamento.departamento_ID = empleados.Departamento_ID GROUP BY departamento.departamento_ID";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $paginas = array_chunk($registros, $registrosPorPagina);
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    // Obtener los registros de la página actual
    $registrosPaginaActual = isset($paginas[$paginaActual - 1]) ? $paginas[$paginaActual - 1] : [];

    echo "<table border=1>";
    echo "<tr><th>Departamento ID</th><th>Ubicación ID</th><th>Salario máximo</th><th>Salario mínimo</th><th>Media de sueldo</th><th>Empleados por departamento</th></tr>";

    // Iterar a través de los registros de la página actual y mostrarlos en la tabla
    foreach ($registrosPaginaActual as $row) {
        echo "<tr><td>".$row['departamento_ID']."</td><td>".$row['Ubicacion_ID']."</td><td>".$row['Salario máximo']."</td><td>".$row['Salario mínimo']."</td><td>".$row['Salario medio']."</td><td>".$row['Total de trabajadores por departamento']."</td></tr>";
    }

    echo "</table>";

    // Enlaces de paginación
    echo "<div class='paginacion'>";
    if ($paginaActual > 1) {
        echo "<a class='pagina' href='informe.php?pagina=".($paginaActual - 1)."'>Anterior</a>";
    }

    for ($i = 1; $i <= count($paginas); $i++) {
        echo "<a class='pagina ".($i == $paginaActual ? 'active' : '')."' href='informe.php?pagina=".$i."'>".$i."</a>";
    }

    if ($paginaActual < count($paginas)) {
        echo "<a class='pagina' href='informe.php?pagina=".($paginaActual + 1)."'>Siguiente</a>";
    }
    echo "</div>";
    ?>

</body>
</html>