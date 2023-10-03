<?php 
// require_once " ./modelo/InterfazDAO.php";
include_once(__DIR__.'/InterfazDAO.php');

    class UsuarioDAO implements InterfazDAO{

        private $DB ="tienda";
        private $user ="root";
        private $pass ="";
        private $servidor ="localhost";
       


        public function __construct(){

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

        public function recuperarUsuario($id,$pass){
            $conn = $this->conexion();
            $sql = "SELECT * FROM usuario WHERE  Email=:id";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }
        public function validarAcceso($id,$pass){

            try {
                $resul= $this->recuperarUsuario($id,$pass);

            if(!empty($resul['Password'])){
                if(password_verify($pass,$resul['Password'])){
                    return $resul['Nombre'];
                }else{
                    return 0;
                }
            }else{
                return 2;
            }

            } catch(PDOException $e){
                die("Error:". $e->getMessage());
            }
        }

    }
?>