<?php
require_once("../modelo/session.php");
require_once("../modelo/control.php");
require_once("../modelo/vivienda.php");
require_once("../controlador/controller.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/buscarVivienda.css">
    <title>Document</title>

</head>

<body>
    <a class='volver' href='../controlador/controller.php?m=viviendas' class='btn'>VOLVER</a>
    <h2 style="text-align: center;">Buscar vivienda</h2>
    <div class="contenedor" style="max-width: 550px; margin: 0 auto;">

        <form action="">
            <fieldset>
                <legend>Introduzca los datos de búsqueda</legend>
                <label for="tipo">Tipo</label>
                <select name="tipo">
                    <option value="piso">Piso</option>
                    <option value="adosado">Adosado</option>
                    <option value="chalet">Chalet</option>
                    <option value="casa">Casa</option>
                </select>
                <br>
                <label for="zona">Zona</label>
                <select name="zona">
                    <option value="centro">Centro</option>
                    <option value="norte">Norte</option>
                    <option value="sur">Sur</option>
                    <option value="este">Este</option>
                    <option value="oeste">Oeste</option>
                </select>

                <div class="extras-box">
                    <h4>Número de habitaciones</h4>
                    <input class="checknewVivienda" type="radio" name="dormi" value="1">1
                    <input class="checknewVivienda" type="radio" name="dormi" value="2">2
                    <input class="checknewVivienda" type="radio" name="dormi" value="3">3
                    <input class="checknewVivienda" type="radio" name="dormi" value="4">4
                    <input class="checknewVivienda" type="radio" name="dormi" value="5">5 o más
                </div>
                <h4>Precio</h4>
                <div class="extras-box">
                    <input class="checknewVivienda" type="radio" name="precio" value="1">-100.000
                    <input class="checknewVivienda" type="radio" name="precio" value="2">100.000-200.000
                    <input class="checknewVivienda" type="radio" name="precio" value="3">200.000-300.000
                    <input class="checknewVivienda" type="radio" name="precio" value="4">>300.000
                </div>

                <br>
                <input type="hidden" name="m" value="busqueda">
                <input type="submit" name="enviar" value="Buscar viviendas">
            </fieldset>
        </form>
    </div>
</body>

</html>