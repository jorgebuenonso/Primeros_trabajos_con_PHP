<?php

    class Conexion{

            private $servidor='localhost';
            private $usuario='root';
            private $clave='';
            private $BBDD='inmobiliaria';
          
            function __construct(){
            
            }

            public function getServidor()
            {
                return $this->servidor;
            }
            
            public function setServidor($servidor)
            {
                $this->servidor = $servidor;

                
            }
            
            public function getUsuario()
            {
                return $this->usuario;
            }
           
            public function setUsuario($usuario)
            {
                $this->usuario = $usuario;
                
            }

            public function getClave()
            {
                return $this->clave;
            }

            public function setClave($clave)
            {
                $this->clave = $clave;
                
            }
            
            public function getBBDD()
            {
                return $this->BBDD;
            }

            public function setBBDD($BBDD)
            {
                $this->BBDD = $BBDD;
          
            }

             function control(){

                try{              
                      
                    $conn = new PDO("mysql:host=". $this->getServidor() .";dbname=".$this->getBBDD().";charset=utf8", $this->getUsuario(),$this->getClave());
                       
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    return $conn; 
                    
                }
                catch(PDOException $e){
                        
                    echo "ERROR: FALLO EN LA CONEXIÓN CON LA BBDD: " . $e->getMESSAGE();
                    
                    
                }

                    
            }
        
    }
