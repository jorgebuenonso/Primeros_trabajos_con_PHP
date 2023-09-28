<?php

    // Validaciones para cliente
    $validacion = false;
    
        if (isset($_POST['empleado_ID']) || isset($_POST['opcionV'])){
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $estado = $_POST['estado'];
        $codigoPostal = $_POST['codigoPostal'];
        $codigoArea = $_POST['codigoArea'];
        $telefono = $_POST['telefono'];
        $limiteDeCredito = $_POST['limiteDeCredito'];
        
            if (isset($_POST['empleado_ID']) && !empty($_POST['empleado_ID'])) {
                $vendedor_ID = $_POST['empleado_ID'];
                $cliente_ID = $_POST['cliente_ID'];
            } elseif (isset($_POST['opcionV']) && !empty($_POST['opcionV'])) {
                $vendedor_ID = $_POST['opcionV'];
                $cliente_ID = $_POST['hidenCodigoC'];
            } else {
                // Manejar el caso en el que ambos están vacíos, si es necesario
                $vendedor_ID = null; // O asigna un valor predeterminado apropiado
            }
        

        // Validación de tipo de dato en PHP

            if (!is_numeric($cliente_ID)) {
                echo "<p style='color: red;'>El campo Cliente ID debe ser un número decimal.</p>";
                echo "<script>alert('El campo Cliente ID debe ser un número decimal.');</script>";
            } elseif (!is_string($nombre) || is_numeric($nombre) || strlen($nombre) > 45) {
                echo "<p style='color: red;'>El campo Nombre debe ser una cadena de texto.</p>";
                echo "<script>alert('El campo Nombre debe ser una cadena de texto.');</script>";
            } elseif (!is_string($direccion) || strlen($direccion) > 40) {
                echo "<p style='color: red;'>El campo Dirección debe ser una cadena de texto.</p>";
                echo "<script>alert('El campo Dirección debe ser una cadena de texto.');</script>";
            } elseif (!is_string($ciudad) || is_numeric($ciudad) || strlen($ciudad) > 30) {
                echo "<p style='color: red;'>El campo Ciudad debe ser una cadena de texto.</p>";
                echo "<script>alert('El campo Ciudad debe ser una cadena de texto.');</script>";
            } elseif (!is_string($estado) || strlen($estado) != 2 || is_numeric($estado)) {
                echo "<p style='color: red;'>El campo Estado debe ser una cadena de texto de 2 caracteres.</p>";
                echo "<script>alert('El campo Estado debe ser una cadena de texto de 2 caracteres.');</script>";
            } elseif (!is_string($codigoPostal) || strlen($codigoPostal) > 9 || !is_numeric($codigoPostal)) {
                echo "<p style='color: red;'>El campo Código Postal debe ser una cadena de texto de 9 caracteres.</p>";
                echo "<script>alert('El campo Código Postal debe ser una cadena de texto de 9 caracteres.');</script>";
            } elseif (!is_numeric($codigoArea) || strlen($codigoArea) > 7) {
                echo "<p style='color: red;'>El campo Código de Área debe ser un número decimal.</p>";
                echo "<script>alert('El campo Código de Área debe ser un número decimal.');</script>";
            } elseif (!is_numeric($telefono) || strlen($telefono) > 7) {
                echo "<p style='color: red;'>El campo Teléfono debe ser un número decimal.</p>";
                echo "<script>alert('El campo Teléfono debe ser un número decimal.');</script>";
            } elseif (!is_numeric($vendedor_ID) || strlen($vendedor_ID) > 4) {
                echo "<p style='color: red;'>El campo Vendedor ID debe ser un número decimal.</p>";
                echo "<script>alert('El campo Vendedor ID debe ser un número decimal.');</script>";
            } elseif (!is_numeric($limiteDeCredito) || strlen($nombre) > 9 && !empty($limiteDeCredito)) {
                echo "<p style='color: red;'>El campo Límite de Crédito debe ser un número decimal.</p>";
                echo "<script>alert('El campo Límite de Crédito debe ser un número decimal.');</script>";
            } else {
                $validacion = true;
            }
        }
       
    //validacion departamento


    if (isset($_POST['departamento_ID']) || isset($_POST['hidenCodigoD'])) {

        if(!isset($_POST['departamento_ID']) && !empty($_POST['departamento_ID'])){
            $departamento_ID = $_POST['departamento_ID'];
        }else{
            $departamento_ID = $_POST['hidenCodigoD'];
        }
        
        $nombre = $_POST['nombre'];


        // Validación de tipo de dato en PHP
        if (!is_numeric($departamento_ID) || strlen($departamento_ID) !== 2) {
            echo "<p style='color: red;'>El campo Departamento ID debe ser un número decimal.</p>";
            echo "<script>alert('El campo Departamento ID debe ser un número decimal.');</script>";
        } elseif (!is_string($nombre) || is_numeric($nombre) || strlen($nombre) > 14) {
            echo "<p style='color: red;'>El campo Nombre debe ser una cadena de texto.</p>";
            echo "<script>alert('El campo Nombre debe ser una cadena de texto.');</script>";
        } else {
            $validacion = true;
        }
    }
    //validacion empleado
    if(isset($_POST['opcionD']) || isset($_POST['hidenCodigoE'])){
        
    if(!isset($_POST['empleado_ID']) && !empty($_POST['empleado_ID'])){
        $empleado_ID = $_POST['empleado_ID'];
        $departamento_ID = $_POST['Departamento_ID'];
        $trabajo_ID = $_POST['Trabajo_ID'];
    }else{
        $empleado_ID = $_POST['hidenCodigoE'];
        $departamento_ID = $_POST['opcionD'];
        $trabajo_ID = $_POST['opcionT'];
    }
        $apellido = $_POST['apellido'];
        $nombre = $_POST['nombre'];
        $inicial = $_POST['inicial'];
        $jefe_ID = $_POST['jefe_ID'];
        $fecha = $_POST['fecha'];
        $salario = $_POST['salario'];
        $comision = $_POST['comision'];

        // Validación de Empleado ID
        if (!is_numeric($empleado_ID) || strlen($empleado_ID) > 4) {
            echo "<p style='color: red;'>El campo Empleado ID debe ser un número decimal de 4 dígitos.</p>";
            echo "<script>alert('El campo Empleado ID debe ser un número decimal de 4 dígitos.');</script>";
        }elseif(!is_string($apellido) || strlen($apellido) > 15) {
            echo "<p style='color: red;'>El campo Apellido debe ser una cadena de texto de máximo 15 caracteres.</p>";
            echo "<script>alert('El campo Apellido debe ser una cadena de texto de máximo 15 caracteres.');</script>";
        }elseif(!is_string($nombre) || strlen($nombre) > 15) {
            echo "<p style='color: red;'>El campo Nombre debe ser una cadena de texto de máximo 15 caracteres.</p>";
            echo "<script>alert('El campo Nombre debe ser una cadena de texto de máximo 15 caracteres.');</script>";
        }elseif(!is_string($inicial) || strlen($inicial) !== 1 || is_numeric(($inicial))) {
            echo "<p style='color: red;'>El campo Inicial del Segundo Apellido debe ser una cadena de texto de 1 caracter.</p>";
            echo "<script>alert('El campo Inicial del Segundo Apellido debe ser una cadena de texto de 1 caracter.');</script>";
        }elseif(!is_numeric($jefe_ID) || strlen($jefe_ID) > 4) {
            echo "<p style='color: red;'>El campo Jefe ID debe ser un número decimal de máximo 4 dígitos.</p>";
            echo "<script>alert('El campo Jefe ID debe ser un número decimal de máximo 4 dígitos.');</script>";
        }elseif(strtotime($fecha) === false) {
            echo "<p style='color: red;'>El campo Fecha de Contrato no es una fecha válida.</p>";
            echo "<script>alert('El campo Fecha de Contrato no es una fecha válida.');</script>";
        }elseif(!is_numeric($salario) && !empty($salario) && !empty($salario)) {
            echo "<p style='color: red;'>El campo Salario debe ser un número decimal.</p>";
            echo "<script>alert('El campo Salario debe ser un número decimal.');</script>";
        }elseif(!is_numeric($comision) && !empty($comision) && !empty($comision)) {
            echo "<p style='color: red;'>El campo Comisión debe ser un número decimal.</p>";
            echo "<script>alert('El campo Comisión debe ser un número decimal.');</script>";
        }elseif(!is_numeric($trabajo_ID) || strlen($trabajo_ID) > 3) {
            echo "<p style='color: red;'>El campo Trabajo ID debe ser un número decimal de 3 dígitos.</p>";
            echo "<script>alert('El campo Trabajo ID debe ser un número decimal de 3 dígitos.');</script>";
        }elseif(!is_numeric($departamento_ID) || strlen($departamento_ID) !== 2) {
            echo "<p style='color: red;'>El campo Departamento ID debe ser un número decimal de 2 dígitos.</p>";
            echo "<script>alert('El campo Departamento ID debe ser un número decimal de 2 dígitos.');</script>";
        } else {
            $validacion = true;
        }
    }
    
    //validacion trabajos

    if (isset($_POST['botonTrabajos']) || isset($_POST['hidenCodigoT'])) {
        if(!isset($_POST['botonTrabajos'])  && !empty($_POST['botonTrabajos'] )){
            $trabajo_ID = $_POST['trabajo_ID'];
        }else{
            $trabajo_ID = $_POST['hidenCodigoT'];
        }
        
        $funcion = $_POST['funcion'];

        // Validación de tipo de dato en PHP
        if (!is_numeric($trabajo_ID) || strlen($departamento_ID) > 3) {
            echo "<p style='color: red;'>El campo Trabajo ID debe ser un número decimal.</p>";
            echo "<script>alert('El campo Trabajo ID debe ser un número decimal.');</script>";
        } elseif (!is_string($funcion) || is_numeric($funcion)) {
            echo "<p style='color: red;'>El campo Función debe ser una cadena de texto.</p>";
            echo "<script>alert('El campo Función debe ser una cadena de texto.');</script>";
        } else {
            $validacion = true;
        }
    }
    //validacion ubicacion
    if (isset($_POST['botonUbicacion']) || isset($_POST['hidenCodigoU'])) {
        if(!isset($_POST['botonUbicacion'])  && !empty($_POST['botonTrabajos'] )){
            $ubicacion_ID = $_POST['ubicacion_ID'];
        }else{
            $ubicacion_ID = $_POST['hidenCodigoU'];
        }
        
        $grupo = $_POST['grupo'];

        // Validación de tipo de dato en PHP
        if (!is_numeric($ubicacion_ID) || strlen($departamento_ID) > 3) {
            echo "<p style='color: red;'>El campo Ubicación ID debe ser un número decimal.</p>";
            echo "<script>alert('El campo Ubicación ID debe ser un número decimal.');</script>";
        } elseif (!is_string($grupo) || is_numeric($grupo)) {
            echo "<p style='color: red;'>El campo Grupo Regional debe ser una cadena de texto.</p>";
            echo "<script>alert('El campo Grupo Regional debe ser una cadena de texto.');</script>";
        } else {
            $validacion = true;
        }
    }
