<?php
    include_once 'control.php';
    include_once("session.php");
    // Verificar la existencia de parámetros GET
    if (isset($_GET['tabla']) && isset($_GET['id']) && isset($_GET['campo'])) {
        $tabla = $_GET['tabla'];
        $id = $_GET['id'];
        $campo = $_GET['campo'];

        // Crear la conexión a la base de datos y manejar errores
        try {
           
            // Consulta preparada para eliminar el registro
            $sql = "DELETE FROM $tabla WHERE $campo = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Éxito: redireccionar o mostrar un mensaje de confirmación
                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE['nombre_usuario'] . " realizó un borrado del  ID $id en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
                
                echo "<script>alert('El borrado fue completado con exito'); window.location.href = 'consulta.php';</script>";
            } else {
                // Error en la ejecución de la consulta
        
                $archivo = fopen("fichero.txt", "a+b");
                fwrite($archivo, "El usuario " . $_COOKIE['nombre_usuario'] . " intentó un borrado del ID $id en fecha: " . date("r") . ";<br/>");
                fclose($archivo);
                
                echo "<script>alert('El borrado no pudo ser completado'); window.location.href = 'consulta.php';</script>";
            }
            
            $conn = null; // Cerrar la conexión

        } catch (PDOException $e) {
            // Manejo de errores de la base de datos
            echo "Error de conexión: " . $e->getMessage();
        }
    } else {
        // Faltan parámetros GET, mostrar un mensaje de error o redirigir según corresponda
        echo "Faltan parámetros GET necesarios.";
}
?>


</body>

</body>

</html>