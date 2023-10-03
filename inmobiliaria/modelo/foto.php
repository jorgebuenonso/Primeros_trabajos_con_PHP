<?php
require_once("../modelo/control.php");
require_once("../controlador/controller.php");
// require_once("../modelo/session.php");

class Foto extends Conexion
{

    private $id;
    private $id_v;
    private $foto;
    private $conn;
    private $fotoArray;

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
    function insertar($id)
    {
        // Verificar si se subió algún archivo
        if (isset($_FILES['foto'])) {
            $fotos_c = $_FILES['foto']['name'];
            $this->foto = implode(',', $fotos_c);
            $this->id_v = $id;
            
            // Verificar si la foto ya se encuentra en la base de datos
            $sql = "SELECT * FROM fotos WHERE  foto = :fot";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fot', $this->foto);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result) {
                $_SESSION['err']= "No se pudo guardar al foto, esta ya se encuentra en la BBDD";
            } else {
                // Insertar registro en la tabla de fotos
                $sql = "INSERT INTO fotos (id_vivienda,foto) VALUES (:idv,:fot)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':idv', $this->id_v);
                $stmt->bindParam(':fot', $this->foto);
                $stmt->execute();
                $_SESSION['err']= "No se pudo guardar al foto, esta ya se encuentra en la BBDD";
            }
        }
    }
    

    function eliminarFoto($id, $name,$idVi)
    {
        $sql = "DELETE FROM fotos WHERE id = $id";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        // Eliminar el archivo de la carpeta
        $file_path = '../fotos/' . $name;
        unlink($file_path);
        
    }

    public function mostrar($condicion)
    {
        $consul = "SELECT *  FROM viviendas
             AS v LEFT JOIN fotos f ON v.id = f.id_vivienda where v.id=" . $condicion . ";";
        $resu = $this->conn->query($consul);

        while ($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
            $this->fotoArray[] = $filas;
        }
        return $this->fotoArray;
    }
}
