<?php
include ('Contrasena.php');

$options =array('uri' =>'http://localhost/Tienda/servicio/');

$server = new SoapServer(NULL,$options);
$server->setClass('Contrasena');
$server->handle();
 
?>