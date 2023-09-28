<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar</title>
    <link rel="stylesheet" href="./css/styleConsulta.css">
</head>

<body>

    <?php
    include_once("session.php");
    include_once("navegador.php");

    if (isset($_GET['tabla'])) {
        $tabla = $_GET['tabla'];
    }

    include_once 'control.php';

    switch ($tabla) { // listo tablas para insertar

        case "cliente":
            $titulo = "Insertar Cliente";
            $campos = [
                'cliente_ID' => 'Cliente ID',
                'nombre' => 'Nombre',
                'direccion' => 'Dirección',
                'ciudad' => 'Ciudad',
                'estado' => 'Estado',
                'codigoPostal' => 'Código Postal',
                'codigoArea' => 'Código de Área',
                'telefono' => 'Teléfono',
                'limiteDeCredito' => 'Límite de Crédito',
                'comentarios' => 'Comentarios'
            ];
            $opcion = 'empleado_ID';
            $texto = 'vendedor ID';
            $sql = 'SELECT empleado_ID FROM EMPLEADOS';
            break;

        case "departamento":
            $titulo = "Insertar Departamento";
            $campos = [
                'departamento_ID' => 'Departamento ID',
                'nombre' => 'Nombre',
            ];
            $opcion = 'Ubicacion_ID';
            $texto = 'ubicación ID';
            $sql = 'SELECT Ubicacion_ID FROM UBICACION';
            break;

        case "empleados":
            $titulo = "Insertar Empleado";
            $campos = [
                'empleado_ID' => 'Empleado ID',
                'apellido' => 'Apellido',
                'nombre' => 'Nombre',
                'inicial' => 'Inicial del Segundo Apellido',
                'fecha' => 'Fecha de contrato',
                'jefe_ID' => 'Jefe ID',
                'salario' => 'Salario',
                'comision' => 'Comisión'
            ];
            $opcion = 'Trabajo_ID';
            $opcion2 = 'Departamento_ID';
            $texto = 'trabajo ID';
            $texto2 = 'departamento ID';
            $sql = 'SELECT Trabajo_ID FROM TRABAJOS';
            $sql2 = 'SELECT Departamento_ID FROM DEPARTAMENTO';
            break;

        case "trabajos":
            $titulo = "Insertar Trabajo";
            $campos = [
                'trabajo_ID' => 'Trabajo ID',
                'funcion' => 'Función'
            ];
            break;

        case "ubicacion":
            $titulo = "Insertar Ubicación";
            $campos = [
                'ubicacion_ID' => 'Ubicación ID',
                'grupo' => 'Grupo Regional'
            ];
            break;
    }
    ?>

    <div class="consulta">
        <div class="consulta-screen">
            <div class="app-title">
                <h1><?php echo $titulo; ?></h1>
            </div>

            <div class="insertar-form">
                <form class="control-group" method="post" style="text-align: center;">
                    <?php foreach ($campos as $campo => $label) : ?>
               
                    <input <?php echo $campo == 'fecha' ? 'type="date" title="Fecha contrato"' : 'type="text"'; ?> name="<?php echo $campo; ?>" placeholder="<?php echo $label; ?>"><br><br>

                    <?php endforeach; ?>

                    <?php if (isset($opcion)) : ?>
                        <div class="control-group">
                            <select style="color: #777;" name="<?php echo $opcion; ?>">
                                <?php
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (count($registros) > 0) {
                                    foreach ($registros as $row) {
                                        $id = $row[$opcion];
                                        echo "<option value='$id'>$texto $id</option>";
                                    }
                                } else {
                                    echo "<option>No hay registros disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($opcion2)) : ?>
                        <div class="control-group">
                            <select style="color: #777;" name="<?php echo $opcion2; ?>">
                                <?php
                                $stmt2 = $conn->prepare($sql2);
                                $stmt2->execute();
                                $registros2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                                if (count($registros2) > 0) {
                                    foreach ($registros2 as $row2) {
                                        $id2 = $row2[$opcion2];
                                        echo "<option value='$id2'>$texto2 $id2</option>";
                                    }
                                } else {
                                    echo "<option>No hay registros disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <input class="comprobar" type="submit" name="boton<?php echo ucfirst($tabla); ?>" value="Insertar">
                </form>
            </div>
        </div>
    </div>


    <?php
    // inicio de inserción.
    include_once("validacion.php");
    if (isset($_REQUEST['botonCliente'])) {


        if ($validacion) {
            $sql = "SELECT COUNT(*) AS 'cantidad' FROM cliente WHERE CLIENTE_ID='" . $_REQUEST['cliente_ID'] . "';";
            $result = $conn->query($sql);
            $num = $result->fetch();
            if ($num['cantidad'] > 0) {

                echo "<br/><p style='color: #ec7063 ; text-align: center';>El cliente ya se encuentra dado de alta</p>";
                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " Intento una inserción de un nuevo cliente con ID " . $_REQUEST['cliente_ID'] . " en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
            } else {

                try {


                    $sql = "INSERT INTO CLIENTE (CLIENTE_ID,nombre,Direccion,Ciudad,Estado,CodigoPostal,CodigoDeArea,Telefono,Vendedor_ID,Limite_De_Credito,Comentarios)"
                        . "VALUES (:cli,:nom, :dir,:ciu,:est,:codP,:codA,:tel,:vend,:limi,:comen)";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':cli', $_REQUEST['cliente_ID']);
                    $stmt->bindParam(':nom', $_REQUEST['nombre']);
                    $stmt->bindParam(':dir', $_REQUEST['direccion']);
                    $stmt->bindParam(':ciu', $_REQUEST['ciudad']);
                    $stmt->bindParam(':est', $_REQUEST['estado']);
                    $stmt->bindParam(':codP', $_REQUEST['codigoPostal']);
                    $stmt->bindParam(':codA', $_REQUEST['codigoArea']);
                    $stmt->bindParam(':tel', $_REQUEST['telefono']);
                    $stmt->bindParam(':vend', $_REQUEST['empleado_ID']);
                    $stmt->bindParam(':limi', $_REQUEST['limiteDeCredito']);
                    $stmt->bindParam(':comen', $_REQUEST['comentarios']);



                    if ($stmt->execute()) {
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Cliente dado de alta correctamente</p>";

                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una inserción de un nuevo cliente con ID " . $_REQUEST['cliente_ID'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    } else {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo cliente con ID " . $_REQUEST['cliente_ID'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    }
                } catch (PDOException $e) {
                    if ($e->getCode() == 'PDOException: SQLSTATE[23000]') //controlo los posible errores con cliente
                        echo "Syntax Error: " . $e->getMessage();

                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento provocando un error una inserción de un nuevo cliente con ID " . $_REQUEST['cliente_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                }
            }


            $conn = null;
        }
    }

    if (isset($_REQUEST['botonDepartamento'])) {

        if ($validacion) {

            $sql = "SELECT COUNT(*) AS 'cantidad' FROM departamento WHERE departamento_ID='" . $_REQUEST['departamento_ID'] . "';";
            $result = $conn->query($sql);
            $num = $result->fetch();
            if ($num['cantidad'] > 0) {

                echo "<br/><p style='color: #ec7063 ; text-align: center';>El departamento ya se encuentra dado de alta</p>";

                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento  una inserción de un nuevo departamento con ID " . $_REQUEST['departamento_ID'] . " en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
            } else {

                $sql = "INSERT INTO DEPARTAMENTO (departamento_ID,Nombre,Ubicacion_ID)"
                    . "VALUES (:dep,:nom,:ubi)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':dep', $_REQUEST['departamento_ID']);
                $stmt->bindParam(':nom', $_REQUEST['nombre']);
                $stmt->bindParam(':ubi', $_REQUEST['Ubicacion_ID']);


                if ($stmt->execute()) {
                    echo "<br/><p style='color:#82e0aa ; text-align: center';>Departamento dado de alta correctamente</p>";

                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una inserción de un nuevo departamento con ID " . $_REQUEST['departamento_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                } else {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo departamento con ID " . $_REQUEST['departamento_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                }
            }

            $conn = null;
        }
    }
    if (isset($_REQUEST['botonEmpleados'])) {

        if ($validacion) {
            

            $sql = "SELECT COUNT(*) AS 'cantidad' FROM empleados WHERE empleado_ID='" . $_REQUEST['empleado_ID'] . "';";
            $result = $conn->query($sql);
            $num = $result->fetch();
            if ($num['cantidad'] > 0) {

                echo "<br/><p style='color: #ec7063 ; text-align: center';>El empleado ya se encuentra dado de alta</p>";

                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo empleado con ID " . $_REQUEST['empleado_ID'] . " en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
            } else {


                $sql = "INSERT INTO EMPLEADOS (empleado_ID,Apellido,Nombre,Inicial_del_segundo_apellido,Trabajo_ID,Jefe_ID,Fecha_contrato,Salario,Comision,Departamento_ID)"
                    . "VALUES (:emp,:ape,:nom,:ini,:tra,:jef,:fec,:sal,:com,:dep)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':emp', $_REQUEST['empleado_ID']);
                $stmt->bindParam(':ape', $_REQUEST['apellido']);
                $stmt->bindParam(':nom', $_REQUEST['nombre']);
                $stmt->bindParam(':ini', $_REQUEST['inicial']);
                $stmt->bindParam(':tra', $_REQUEST['Trabajo_ID']);
                $stmt->bindParam(':jef', $_REQUEST['jefe_ID']);
                $stmt->bindParam(':fec', $_REQUEST['fecha']);
                $stmt->bindParam(':sal', $_REQUEST['salario']);
                $stmt->bindParam(':com', $_REQUEST['comision']);
                $stmt->bindParam(':dep', $_REQUEST['Departamento_ID']);


                if ($stmt->execute()) {
                    echo "<br/><p style='color:#82e0aa ; text-align: center';>Empleado dado de alta correctamente</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una inserción de un nuevo empleado con ID " . $_REQUEST['empleado_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                } else {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo empleado con ID " . $_REQUEST['empleado_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                }
            }

            $conn = null;
        }
    }

    if (isset($_REQUEST['botonTrabajos'])) {

        if ($validacion) {
            $sql = "SELECT COUNT(*) AS 'cantidad' FROM trabajos WHERE Trabajo_ID='" . $_REQUEST['trabajo_ID'] . "';";
            $result = $conn->query($sql);
            $num = $result->fetch();
            if ($num['cantidad'] > 0) {

                echo "<br/><p style='color: #ec7063 ; text-align: center';>El trabajo ya se encuentra dado de alta</p>";
                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo trabajo con ID " . $_REQUEST['trabajo_ID'] . " en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
            } else {


                $sql = "INSERT INTO TRABAJOS (Trabajo_ID,Funcion)"
                    . "VALUES (:tra,:fun)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':tra', $_REQUEST['trabajo_ID']);
                $stmt->bindParam(':fun', $_REQUEST['funcion']);

                if ($stmt->execute()) {
                    echo "<br/><p style='color:#82e0aa ; text-align: center';>Trabajo dado de alta correctamente</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una inserción de un nuevo trabajo con ID " . $_REQUEST['trabajo_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                } else {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de un nuevo trabajo con ID " . $_REQUEST['trabajo_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                }
            }

            $conn = null;
        }
    }

    if (isset($_REQUEST['botonUbicacion'])) {

        if ($validacion) {

            $sql = "SELECT COUNT(*) AS 'cantidad' FROM ubicacion WHERE Ubicacion_ID='" . $_REQUEST['ubicacion_ID'] . "';";
            $result = $conn->query($sql);
            $num = $result->fetch();
            if ($num['cantidad'] > 0) {

                echo "<br/><p style='color: #ec7063 ; text-align: center';>La ubicación ya se encuentra dada de alta</p>";
                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de una nueva ubicación con ID " . $_REQUEST['ubicacion_ID'] . " en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
            } else {

                $sql = "INSERT INTO UBICACION (Ubicacion_ID,GrupoRegional)"
                    . "VALUES (:ubi,:gru)";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':ubi', $_REQUEST['ubicacion_ID']);
                $stmt->bindParam(':gru', $_REQUEST['grupo']);

                if ($stmt->execute()) {
                    echo "<br/><p style='color:#82e0aa ; text-align: center';>Ubicación dada de alta correctamente</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una inserción de una nueva ubicación con ID " . $_REQUEST['ubicacion_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                } else {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                    $archivo = fopen("fichero.txt", "a+b");
                    fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una inserción de una nueva ubicación con ID " . $_REQUEST['ubicacion_ID'] . " en fecha: " . date("r") . ";<br/>");
                    fclose($archivo);
                }
            }
        }
        $conn = null;
    }

    ?>

</body>

</html>