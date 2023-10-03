<?php
class ClienteServicio {

    public function conexionServicio(){
        // Definimos las opciones para la conexión SOAP
        $options = array(
            "uri" => "http://localhost/Tienda/servicio/", // Ubicación del archivo WSDL
            "location" => "http://localhost/Tienda/servicio/serverSoap.php" // Ubicación del archivo PHP que contiene la definición del servicio
        );
        // Creamos una instancia de la clase SoapClient con las opciones definidas anteriormente
        $cliente = new SoapClient(null, $options);
        // Devolvemos el objeto SoapClient creado
        return $cliente;
    }

    // Método para comprobar una contraseña llamando a un método en el servicio web SOAP
    public function comprueba($pass){
        try {
            // Creamos una instancia de SoapClient llamando al método conexionServicio() definido anteriormente
            $servicio = $this->conexionServicio();
            // Llamamos al método compruebacontra($pass) en el servicio web y guardamos la respuesta en la variable $respuesta
            $respuesta = $servicio->compruebacontra($pass);
            // Devolvemos la respuesta del servicio web
            return $respuesta;
        } catch (SoapFault $e) {
            // Si se produce un error, devolvemos un mensaje de error
            return "Error: ". $e->getMessage();
        } 
    }
}
?>