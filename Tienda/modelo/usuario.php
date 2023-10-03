<?php 

    require_once "../modelo/dataSource.php";

    class Usuario extends DataSource{

        private $nombre;
        private $apellidos;
        private $domicilio;
        private $numTelefono;
        private $email;
        private $username;
        private $password;
        private $conn;
      


        public function __construct()
        {

          $this->conn= parent::conexion(); 
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

    // function insertar()
    // {

    //     $sql = "SELECT COUNT(*) AS 'cantidad' FROM usuario WHERE Email='" . $this->email . "';";
    //     $result = $this->conn->query($sql);
    //     $num = $result->fetch();
       
    //     if ($num['cantidad'] > 0) {
    //     } else {

    //         $sql = "INSERT INTO usuario (Nombre,Apellidos,Domicilio,NumTelefono, Email, password) VALUES (:nom,:ape,:domi,:num,:email,:pass)";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bindParam(':nom', $this->nombre);
    //         $stmt->bindParam(':ape', $this->apellidos);
    //         $stmt->bindParam(':domi', $this->domicilio);
    //         $stmt->bindParam(':num', $this->numTelefono);
    //         $stmt->bindParam(':email', $this->email);
    //         $stmt->bindParam(':pass', $this->password);

    //         $stmt->execute();

    //         return 1;
           
    //     }
    //     return 2;
    // }

    }
?>