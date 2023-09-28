<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleConsulta.css">
    <title>fichero</title>
</head>
<body>

    <?php include_once("session.php");
          include_once("navegador.php");
           // por seguridad me aseguro de que los empreados sin acceso no puedan acceder al contenido de informe
        if($_SESSION['cargo']!='presidente' ){
        header("Location:consulta.php");
        }
    ?>

    <h1 id="titulo">Fichero de operaciones</h1>
    <!-- registro de todas las acciones de realizada por los distintos usuarios, esta sol oestara disponible para el presidente -->
    
    <?php
    // si esta en archivo lo abro y si no lo creo, compruebo si hay datos y si es así los saco por pantalla.

            if(file_exists("fichero.txt")){
                $archivo =fopen("fichero.txt","rb");
                if($archivo ==false){
                    echo "<br/><p style='color: #ec7063 ; text-align: center';>Error al abrir el fichero</p>";
                }else{
                    $cadena = file_get_contents("fichero.txt");
                    echo "<table class='table-fichero' border='1'>
                                <tr>
                                    <th>
                                        <p>".$cadena."</p>
                                    </th>
                                </tr>
                            </table>";
        
                    $archivo = fopen("fichero.txt","a+b");
                    fwrite($archivo,"El usuario ".$_COOKIE['nombre_usuario']." entro en fichero en fecha: ".date("r").";<br/>");
                    fclose($archivo);
                }
            }else{
                echo "<br/><p style='color: #ec7063 ; text-align: center';>Fichero vacío</p>";
            }
        
       
       
?>
    
</body>
</html>