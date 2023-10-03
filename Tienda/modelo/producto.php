<?php 
    require_once "../modelo/dataSource.php";

    class Producto extends Datasource{

        private $codProduct;
        private $nombre;
        private $PVP;
        private $descripcion;
        private $conn;

        public function __construct()
        {
           $this->conn = parent::conexion();
        }

        // function crud()
        // {
        //     $dataS= new DataSource();

        //     $sql = "INSERT INTO producto (codProd,Nombre,PVC,Descripcion) VALUES (:cod,:nom,:pvc,:des)";
        //         // $stmt = $this->conn->prepare($sql);
        //     $resultado=$dataS->ejecutarConsulta($sql,array(':cod' => $this->codProduct,':nom' => $this->nombre,':pvc' => $this->PVC,':des' => $this->descrpcion));
               
                
        //     }
    
         

        function mostrar(){
            $sql="SELECT * FROM producto";

            $stmt = $this->conn->query($sql);
            $stmt->execute();
    
            while ($filas = $stmt->FETCHALL(PDO::FETCH_ASSOC)) {
                $dato[] = $filas;
            }
            return $dato;
        }

        
        public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    }
?>