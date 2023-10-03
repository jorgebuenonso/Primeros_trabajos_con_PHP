<?php
require_once("../modelo/control.php");
// require_once("../modelo/session.php");

class Vivienda extends Conexion
{

    private $id;
    private $tipo;
    private $zona;
    private $dire;
    private $dormi;
    private $precio;
    private $tamano;
    private $extras;
    private $obs;
    private $fecha;
    private $conn;
    private $dato;


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

    function actualizar()
    {

        if (!empty($_REQUEST['extras'])) {
            $extras_c = $_REQUEST['extras'];
            $this->extras = implode(',', $extras_c);
        } else {
            $this->extras = "";
        }

        $sql = "UPDATE viviendas SET  id= :idV ,tipo= :tip, zona= :zona, direccion= :dire, ndormitorios= :dor
            ,precio= :pre, tamano= :tama, extras= :ext, observaciones= :obs, fecha_anuncio= :fech WHERE id= :idV";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idV', $this->id);
        $stmt->bindParam(':tip', $this->tipo);
        $stmt->bindParam(':zona', $this->zona);
        $stmt->bindParam(':dire', $this->dire);
        $stmt->bindParam(':dor', $this->dormi);
        $stmt->bindParam(':pre', $this->precio);
        $stmt->bindParam(':tama', $this->tamano);
        $stmt->bindParam(':ext', $this->extras);
        $stmt->bindParam(':obs', $this->obs);
        $stmt->bindParam(':fech', $this->fecha);

        $stmt->execute();

    }

    function insertar()
    {

        $sql = "SELECT COUNT(*) AS 'cantidad' FROM viviendas WHERE id='" . $this->id . "';";
        $result = $this->conn->query($sql);
        $num = $result->fetch();

        if ($num['cantidad'] > 0) {

            $_SESSION['error'] = "no se puede dar de alta, el anuncio ya se encuentra registado";
        } else {

            if (!empty($_REQUEST['extras'])) {
                $extras_c = $_REQUEST['extras'];
                $this->extras = implode(',', $extras_c);
            } else {
                $this->extras = "";
            }

            $sql = "INSERT INTO viviendas (tipo,zona,direccion,ndormitorios,precio,tamano,extras,observaciones,fecha_anuncio) 
                     VALUES (:tip,:zona,:dire,:ndor,:pre,:tam,:ext,:obs,:fec)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':tip', $this->tipo);
            $stmt->bindParam(':zona', $this->zona);
            $stmt->bindParam(':dire', $this->dire);
            $stmt->bindParam(':ndor', $this->dormi);
            $stmt->bindParam(':pre', $this->precio);
            $stmt->bindParam(':tam', $this->tamano);
            $stmt->bindParam(':ext', $this->extras);
            $stmt->bindParam(':obs', $this->obs);
            $stmt->bindParam(':fec', $this->fecha);

            $stmt->execute();
            $id = $this->conn->lastInsertId(); // con lastInsertId() consigo la id registrada en la operación, la retomo para poder relacionar la foto con la vivienda

            return $id;
        }
    }

    function busqueda()
    {

        $num = "";
        $precio = "";
        if (!empty($_REQUEST['precio'])) {
            if ($_REQUEST['precio'] == 1) {
                $precio = "<100000";
            } else if ($_REQUEST['precio'] == 2) {
                $precio = "BETWEEN 100000 AND 200000";
            } else if ($_REQUEST['precio'] == 3) {
                $precio = "BETWEEN 200000 AND 300000";
            } else if ($_REQUEST['precio'] == 4) {
                $precio = ">300000";
            }
        } else {
            $precio = ">=0";
        }

        if (!empty($_REQUEST['dormi'])) {
            if ($_REQUEST['dormi'] == 5) {
                $num = "ndormitorios>=";
            } else {
                $num = 'ndormitorios=';
            }
        } else {
            $num = 'ndormitorios>=0';
        }

        $this->precio = $precio;

        $sql =  " SELECT v.*, f.foto  AS nombres_fotos FROM viviendas v 
                    LEFT JOIN fotos f ON v.id = f.id_vivienda
                    WHERE tipo = '" . $this->tipo . "' AND 
                        zona = '" . $this->zona . "' AND 
                        " . $num . $this->dormi . " AND 
                        precio " . $this->precio;

        $stmt = $this->conn->query($sql);

        $filas = $stmt->FETCHALL(PDO::FETCH_ASSOC);

        if (count($filas) > 0) {
            $this->dato[] = $filas;
        } else {
            $this->dato = "";
        }

        return $this->dato;
    }
}
