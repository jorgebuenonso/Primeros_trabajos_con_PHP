
<?php

require_once("../modelo/control.php");
// require_once("../modelo/session.php");

class Usuario extends Conexion
{

    private $username;
    private $password;
    private $conn;
    private $id;

    public function __construct()
    {

        $this->conn = parent::control();
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

    public function comprobarPass($nom, $pass)
    {

        $sql = "SELECT password FROM usuarios WHERE id_usuario = '$nom'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $registros = $stmt->fetchAll((PDO::FETCH_ASSOC));

        foreach ($registros as $row) {
            if (password_verify($pass, $row["password"])) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    function insertar()
    {

        $sql = "SELECT COUNT(*) AS 'cantidad' FROM usuarios WHERE id_usuario='" . $this->id . "';";
        $result = $this->conn->query($sql);
        $num = $result->fetch();
        echo "<script>alert('" . $num['cantidad'] . "</script>";

        if ($num['cantidad'] > 0) {
        } else {

            $sql = "INSERT INTO usuarios (id_usuario, password) VALUES (:id,:pass)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':pass', $this->password);

            $stmt->execute();

            return 1;
           
        }
        return 2;
    }
}


?>