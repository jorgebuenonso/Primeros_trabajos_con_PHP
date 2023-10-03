<?php 

    class DataSource{

        private $DB ="tienda";
        private $user ="root";
        private $pass ="";
        private $servidor ="localhost";
        private $tabla;
       
        public function __construct($tabla) {
           
            $this->tabla = $tabla;
        }

        public function conexion(){
            try {
                $conn = new PDO("mysql:host=$this->servidor;dbname=$this->DB", $this->user, $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            }catch(PDOException $e){
                die("Error:". $e->getMessage());
            }
        }

         // Estas consultas hacen todo 
    // --> SENTENCIA PREPARADA
    // $bbdd->ejecutarConsulta("INSERT INTO usuarios (id_usuario, password) VALUES ('admin', :cifrado) ON DUPLICATE KEY UPDATE id_usuario = 'admin', password =  :cifrado;",array(':cifrado' => $cifrado));
    public function ejecutarConsulta($sql = "", $valores = array()){ // Por defecto no hay nada y valores igual, si no hay nada, es un array vacio
        if($sql != ""){
            $dato=array();
            $conn = $this->conexion(); // Llamamos a conectar de la clase Conexion
            $stmt = $conn->prepare($sql);
            $stmt->execute($valores);
            
            while ($filas = $stmt->FETCHALL(PDO::FETCH_ASSOC)) {
                $dato[] = $filas;
            }
            return $dato;
            
            // return $datos;
        }else{
            return 0; // False
        }
    }

    // --> CONSULTA NO PREPARADA (para las querys)
    // $stmt = $bbdd->consulta("SELECT * FROM usuarios "); ejemplo
    public function consulta($sql = "",$paginacion="false"){
        if($paginacion=="false"){
            if($sql != ""){
                $conn = $this->conexion();
                $stmt = $conn->query($sql);
                $stmt->execute();

                while ($filas = $stmt->FETCHALL(PDO::FETCH_ASSOC)) {
                    $dato[] = $filas;
                }
                return $dato;
            }else{
                return 0;
            }
        }else{
            
           return $this->paguinacion($this->tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
        }
        
    }

    public function paguinacion(&$tabla, &$productosPorPagina, &$pagina, &$paginas, &$dato, &$conteo)
    {
       
        $conn = $this->conexion();
       
        //Cuántos productos mostrar por página
        $productosPorPagina = 3;
        // Por defecto es la página 1; pero si está presente en la URL, tomamos esa
        $pagina = 1;
        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }
        # El límite es el número de productos por página
        $limit = $productosPorPagina;
        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
        $offset = ($pagina - 1) * $productosPorPagina;
        # Necesitamos el conteo para saber cuántas páginas vamos a mostrar iria $tabla
        $sql = "SELECT count(*) AS conteo FROM ". $this->tabla;
        $stmt = $conn->query($sql);
        $conteo = $stmt->fetchObject()->conteo;
        # Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
        $paginas = ceil($conteo / $productosPorPagina);

        # Ahora obtenemos los productos usando ya el OFFSET y el LIMIT
       
        $sqll = "SELECT * FROM $this->tabla LIMIT $limit OFFSET $offset"; 

        $stmt = $conn->query($sqll);
        $stmt->execute();

        while ($filas = $stmt->FETCHALL(PDO::FETCH_ASSOC)) {
            $dato[] = $filas;
        }
    }
}

    
?>