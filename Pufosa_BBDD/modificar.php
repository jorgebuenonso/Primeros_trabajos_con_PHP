<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
    <link rel="stylesheet" href="./css/styleConsulta.css">
</head>

<body>

    <?php include_once("session.php");
    include_once("navegador.php");
    ?>

    <h1 id="titulo">Modificar Bases de Datos</h1>

    <?php
    include_once 'control.php';

    if (isset($_GET['id']) && isset($_GET['tabla'])) {
        $tabla = $_GET['tabla'];
        $id = $_GET['id'];

        switch ($tabla) {

            case 'cliente':

                $sql = "SELECT * FROM CLIENTE WHERE CLIENTE_ID= :cod;";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod', $id);
                $stmt->execute();
                $reg = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($reg <= 0) {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>El cliente no se encuentra dado de alta</p>";
                } else { ?>

                    <div class=''>
                        <div class='consulta-screen'>

                            <div class='modificar-div'>
                                <form class='modificar-form' method='post'>
                                    <div class="input-row">
                                        <label for="hidenCodigoC">Cliente ID</label>
                                        <input type='text' name='hidenCodigoC' value='<?php echo $reg['CLIENTE_ID']; ?>' readonly>
                                    </div>
                                    <div class="input-row">
                                        <label for="nombre">Nombre</label>
                                        <input type='text' name='nombre' value='<?php echo $reg['nombre']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="direccion">Dirección</label>
                                        <input type='text' name='direccion' value='<?php echo $reg['Direccion']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="ciudad">Ciudad</label>
                                        <input type='text' name='ciudad' value='<?php echo $reg['Ciudad']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="estado">Estado</label>
                                        <input type='text' name='estado' value='<?php echo $reg['Estado']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="postal">Código postal</label>
                                        <input type='text' name='codigoPostal' value='<?php echo $reg['CodigoPostal']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="area">Código de área</label>
                                        <input type='text' name='codigoArea' value='<?php echo $reg['CodigoDeArea']; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="telefono">Teléfono</label>
                                        <input type='text' name='telefono' value='<?php echo $reg['Telefono']; ?>'>
                                    </div>

                                    <div class="input-row">
                                        <label for="credito">Límite de Crédito</label>
                                        <input type='text' name='limiteDeCredito' value='<?php echo $reg['Limite_De_Credito']; ?>'>
                                    </div>

                                    <div class="input-row">
                                        <label for="comentarios">Comentarios</label>
                                        <input type='text' name='comentarios' value='<?php echo $reg['Comentarios']; ?>'>
                                    </div>

                                    <?php
                                    $sql = 'SELECT empleado_ID FROM EMPLEADOS';
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if (count($registros) > 0) { ?>
                                        <div class='input-row'><select class="select-modificar" style='color: #777' name='opcionV'>";

                                            <?php foreach ($registros as $row) {
                                                $selected = ($row['empleado_ID'] == $id) ? "selected" : "";
                                                echo "<option value='{$row["empleado_ID"]}' {$selected}>Vendedor ID{$row['empleado_ID']}</option>";
                                            }
                                        }
                                            ?>
                                            </select>
                                        </div>

                                        <input type='hidden' name='hidenTabla' value='<?php echo $tabla; ?>'><br><br />
                                        <input class='comprobar-modificar' type='submit' name='btnModificar' value='Modificar'>

                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                }
                case 'departamento':
                    $sql = "SELECT * FROM DEPARTAMENTO WHERE departamento_ID= :cod;";
                
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':cod', $id);
                    $stmt->execute();
                    $reg = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    if ($reg <= 0) {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>El departamento no se encuentra dado de alta</p>";
                    } else {
                        $sql = "SELECT Ubicacion_ID FROM UBICACION";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $ubicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                
                        <div class=''>
                            <div class='consulta-screen'>
                                <div class='app-title'>
                                    <h1>Modificar Departamento</h1>
                                </div>
                
                                <div class='modificar-div'>
                                    <form class='modificar-form' method='post'>
                                        <div class="input-row">
                                            <label for="hidenCodigoD">Departamento ID</label>
                                            <input type='text' name='hidenCodigoD' value='<?php echo $reg["departamento_ID"]; ?>' readonly>
                                        </div>
                                        <div class="input-row">
                                            <label for="nombre">Nombre</label>
                                            <input type='text' name='nombre' value='<?php echo $reg["Nombre"]; ?>'>
                                        </div>
                                        <div class="input-row">
                                            <select class="select-modificar" style='color: #777' name='ubicacion'>
                                                <?php foreach ($ubicaciones as $row) {
                                                    $selected = ($row['Ubicacion_ID'] == $reg['Ubicacion_ID']) ? "selected" : "";
                                                ?>
                                                    <option value='<?php echo $row["Ubicacion_ID"]; ?>' <?php echo $selected; ?>>Ubicación ID<?php echo $row["Ubicacion_ID"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                
                                        <input type='hidden' name='hidenTabla' value='<?php echo $tabla; ?>'>
                                        <div class="input-row">
                                            <input class='comprobar-modificar' type='submit' name='btnModificar' value='Modificar'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    break;
                

            case 'empleados':

                $sql = "SELECT * FROM EMPLEADOS WHERE empleado_ID= :cod;";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod', $id);
                $stmt->execute();
                $reg = $stmt->fetch(PDO::FETCH_ASSOC);


                if ($reg <= 0) {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>El empleado no se encuentra dado de alta</p>";
                } else { ?>


                    <div class='consulta'>
                        <div class='consulta-screen'>
                            <div class='app-title'>
                                <h1>Modificar empleado</h1>
                            </div>

                            <div class='modificar-div'>
                                <form class='modificar-form' method='post'>
                                    <div class="input-row">
                                        <label for="hidenCodigoE">Empleado ID</label>
                                        <input type='text' name='hidenCodigoE' value='<?php echo $reg["empleado_ID"]; ?>' readonly>
                                    </div>
                                    <div class="input-row">
                                        <label for="nombre">Nombre</label>
                                        <input type='text' name='nombre' value='<?php echo $reg["Nombre"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="apellido">Apellido</label>
                                        <input type='text' name='apellido' value='<?php echo $reg["Apellido"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="inicial">Inicial segundo nombre</label>
                                        <input type='text' name='inicial' value='<?php echo $reg["Inicial_del_segundo_apellido"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="jefe_ID">Jefe ID</label>
                                        <input type='text' name='jefe_ID' value='<?php echo $reg["Jefe_ID"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="fecha">Fecha contrato</label>
                                        <input type='text' name='fecha' value='<?php echo $reg["Fecha_contrato"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="salario">Salario</label>
                                        <input type='text' name='salario' value='<?php echo $reg["Salario"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="comision">Comisión</label>
                                        <input type='text' name='comision' value='<?php echo $reg["Comision"]; ?>'>
                                    </div>
                                    <div class="input-row">
                                        <label for="fecha">Fecha</label>
                                        <input type='date' name='fecha' value='<?php echo $reg["Fecha_contrato"]; ?>'>
                                    </div>

                                    <?php
                                    $sql = 'SELECT Trabajo_ID FROM TRABAJOS'; // lo mismo que con cliente, controlamos futuros errores con las claves ajena, dandole a elgir entre las registradas en la BBDD 
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $registros = $stmt->fetchAll((PDO::FETCH_ASSOC));


                                    if (count($registros) > 0) { ?>

                                        <div class="input-row">
                                            <select class="select-modificar" style='color: #777' name='opcionT'>
                                                <?php foreach ($registros as $row) : ?>
                                                    <?php
                                                    $selected = ($row['Trabajo_ID'] == $id) ? "selected" : "";
                                                    ?>
                                                    <option value='<?php echo $row["Trabajo_ID"]; ?>' <?php echo $selected; ?>>Trabajo ID<?php echo $row["Trabajo_ID"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php
                                        $sql = 'SELECT departamento_ID FROM departamento';
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        if (count($registros) > 0) {
                                        ?>
                                            <div class='input-row'>
                                                <select class="select-modificar" style='color: #777' name='opcionD'>
                                                    <?php foreach ($registros as $row) :

                                                        $selected = ($row['departamento_ID'] == $id) ? "selected" : "";
                                                    ?>
                                                        <option value='<?php echo $row["departamento_ID"]; ?>' <?php echo $selected; ?>>Departamento ID<?php echo $row["departamento_ID"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                    <?php
                                        } else {
                                            echo "No hay departamentos en la base de datos";
                                        }
                                    }
                                    ?>

                                    <input type='hidden' name='hidenTabla' value='<?php echo $tabla; ?>'><br><br />
                                    <input class='comprobar-modificar' type='submit' name='btnModificar' value='Modificar'>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php };

                break;

            case 'trabajos':

                $sql = "SELECT * FROM TRABAJOS WHERE trabajo_ID= :cod;";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod', $id);
                $stmt->execute();
                $reg = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($reg <= 0) {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>El trabajo no se encuentra dado de alta</p>";
                } else { ?>


                    <div class='consulta'>
                        <div class='consulta-screen'>
                            <div class='app-title'>
                                <h1>Modificar por ID</h1>
                            </div>

                            <div class='modificar-div'>
                                <form class='modificar-form' method='post'>
                                    <div class="input-row">
                                        <label for="hidenCodigo">Trabajo ID</label>
                                        <input type='text' name='hidenCodigoT' value='<?php echo $reg['Trabajo_ID']; ?>' readonly><br><br />
                                    </div>
                                    <div class="input-row">
                                        <label for="funcion">Función</label>
                                        <input type='text' name='funcion' value='<?php echo $reg['Funcion']; ?>'><br><br />
                                    </div>
                                    <input type='hidden' name='hidenTabla' value='<?php echo $tabla; ?>'><br><br />
                                    <div class="input-row">
                                        <input class='comprobar-modificar' type='submit' name='btnModificar' value='Modificar'>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>;
                <?php }

                break;

            case 'ubicacion':

                $sql = "SELECT * FROM UBICACION WHERE Ubicacion_ID= :cod;";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cod', $id);
                $stmt->execute();
                $reg = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($reg <= 0) {
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>La ubicación no se encuentra dado de alta</p>";
                } else { ?>


                    <div class='consulta'>
                        <div class='consulta-screen'>
                            <div class='app-title'>
                                <h1>Modificar por ID</h1>
                            </div>
                            <div class='modificar-div'>
                                <form class='modificar-form' method='post'>
                                    <div class="input-row">
                                        <label for="hidenCodigo">Ubicación ID</label>
                                        <input type='text' name='hidenCodigoU' value='<?php echo $reg['Ubicacion_ID']; ?>' readonly><br><br />
                                    </div>
                                    <div class="input-row">
                                        <label for="grupo">Grupo regional</label>
                                        <input type='text' name='grupo' value='<?php echo $reg['GrupoRegional']; ?>'><br><br />
                                    </div>
                                    <input type='hidden' name='hidenTabla' value='<?php echo $tabla; ?>'><br><br />
                                    <div class="input-row">
                                        <input class='comprobar-modificar' type='submit' name='btnModificar' value='Modificar'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>;
        <?php }

                break;
        }
    }

    include_once("validacion.php");
    $exito=false;
    if (isset($_REQUEST['btnModificar'])) { // aquí modificamos los campos elegidos por el usuario.

        if ($validacion) {
            switch ($tabla) {

                case 'cliente':

                    $sql = "UPDATE CLIENTE SET Nombre=:nom,Direccion=:dir,Ciudad=:ciu,Estado=:est,CodigoPostal=:codP,CodigoDeArea=:codA,Telefono=:tel,"
                        . "Vendedor_ID=:vend,Limite_De_Credito=:limi,Comentarios=:comen WHERE CLIENTE_ID=:cod;";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':nom', $_REQUEST['nombre']);
                    $stmt->bindParam(':dir', $_REQUEST['direccion']);
                    $stmt->bindParam(':ciu', $_REQUEST['ciudad']);
                    $stmt->bindParam(':est', $_REQUEST['estado']);
                    $stmt->bindParam(':codP', $_REQUEST['codigoPostal']);
                    $stmt->bindParam(':codA', $_REQUEST['codigoArea']);
                    $stmt->bindParam(':tel', $_REQUEST['telefono']);
                    $stmt->bindParam(':vend', $_REQUEST['opcionV']);
                    $stmt->bindParam(':limi', $_REQUEST['limiteDeCredito']);
                    $stmt->bindParam(':comen', $_REQUEST['comentarios']);
                    $stmt->bindParam(':cod', $_REQUEST['hidenCodigoC']);


                    if ($stmt->execute()) {
                        $exito=true;
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Cliente modificado correctamente</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una modificación del cliente con ID " . $_REQUEST['hidenCodigoC'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    } else {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una modificación del cliente con ID " . $_REQUEST['hidenCodigoC'] . " en fecha: " . date("r") . "<br/>;");
                        fclose($archivo);
                    }

                    break;

                case 'departamento':

                    $sql = "UPDATE DEPARTAMENTO SET Nombre=:nom, Ubicacion_ID =:ubi WHERE departamento_ID = :cod;";


                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':nom', $_REQUEST['nombre']);
                    $stmt->bindParam(':ubi', $_REQUEST['ubicacion']);
                    $stmt->bindParam(':cod', $_REQUEST['hidenCodigoD']);


                    if ($stmt->execute()) {
                        $exito=true;
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Departamento modificado correctamente</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una modificación del departamento con ID " . $_REQUEST['hidenCodigoD'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    }

                    break;

                case 'empleados':

                    $sql = "UPDATE EMPLEADOS SET Nombre=:nom,Apellido=:ape,Inicial_del_segundo_apellido=:ini,Trabajo_ID=:tra,Jefe_ID=:jef,Fecha_contrato=:fec,Salario=:sal,Comision=:com,"
                        . "Departamento_ID=:dep WHERE empleado_ID=:cod;";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':nom', $_REQUEST['nombre']);
                    $stmt->bindParam(':ape', $_REQUEST['apellido']);
                    $stmt->bindParam(':ini', $_REQUEST['inicial']);
                    $stmt->bindParam(':tra', $_REQUEST['opcionT']);
                    $stmt->bindParam(':jef', $_REQUEST['jefe_ID']);
                    $stmt->bindParam(':fec', $_REQUEST['fecha']);
                    $stmt->bindParam(':sal', $_REQUEST['salario']);
                    $stmt->bindParam(':com', $_REQUEST['comision']);
                    $stmt->bindParam(':dep', $_REQUEST['opcionD']);

                    $stmt->bindParam(':cod', $_REQUEST['hidenCodigoE']);

                    if ($stmt->execute()) {
                        $exito=true;
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Empleado modificado correctamente</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una modificación del empleado con ID " . $_REQUEST['hidenCodigoE'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    } else {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una modificación del empleado con ID " . $_REQUEST['hidenCodigoE'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    }

                    break;

                case 'trabajos':

                    $sql = "UPDATE TRABAJOS SET Funcion=:fun WHERE Trabajo_ID=:cod;";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':fun', $_REQUEST['funcion']);
                    $stmt->bindParam(':cod', $_REQUEST['hidenCodigoT']);

                    if ($stmt->execute()) {
                        $exito=true;
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Trabajo modificado correctamente</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una modificación del trabajo con ID " . $_REQUEST['hidenCodigoT'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    } else {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una modificación del trabajo con ID " . $_REQUEST['hidenCodigoT'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    }

                    break;

                case 'ubicacion':

                    $sql = "UPDATE UBICACION SET GrupoRegional=:gru WHERE Ubicacion_ID=:cod;";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':gru', $_REQUEST['grupo']);
                    $stmt->bindParam(':cod', $_REQUEST['hidenCodigoU']);

                    if ($stmt->execute()) {
                        $exito=true;
                        echo "<br/><p style='color:#82e0aa ; text-align: center';>Ubicación modificada correctamente</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " realizo una modificación del ubicación con ID " . $_REQUEST['hidenCodigoU'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    } else {
                        echo "<br/><p style='color: #ec7063 ; text-align: center';>No se pudo realizo la operación</p>";
                        $archivo = fopen("fichero.txt", "a+b");
                        fwrite($archivo, "El usuario " . $_COOKIE["nombre_usuario"] . " intento una modificación del ubicación con ID " . $_REQUEST['hidenCodigoU'] . " en fecha: " . date("r") . ";<br/>");
                        fclose($archivo);
                    }

                    break;
            }

            
        }
       
        $conn = null;
        if($exito){ ?>
            <script> 
            // Espera 3000 milisegundos (3 segundos) y luego redirige a la nueva página
            setTimeout(function() {
                window.location.href = 'consulta.php';
            }, 2000); // 3000 milisegundos = 3 segundos
           </script>
       <?php } ?>
        
        
        
    <?php } ?>

</body>

</html>