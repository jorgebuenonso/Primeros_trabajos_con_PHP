<?php
require_once("../modelo/control.php");
class Modelo extends Conexion
{

    private $conn;
    private $datos;
    private $Modelo;
    private $registros;


    public function __construct()
    {
        $this->Modelo = array();
        $this->conn = parent::control();
    }

    public function mostrarIndex()
    {


        return $this->conn;
    }

    public function mostrar($tabla, $condicion)
    {
        $consul = "SELECT * FROM  viviendas
             AS v where v." . $condicion . ";";
        $resu = $this->conn->query($consul);

        while ($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
            $this->datos[] = $filas;
        }
        return $this->datos;
    }

    public function eliminar($tabla, $condicion)
    {
        echo $tabla . " " . $condicion;
        $eli = "delete from " . $tabla . " where " . $condicion;
        $res = $this->conn->query($eli);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function paguinacion($tabla, &$productosPorPagina, &$pagina, &$paginas, &$dato, &$conteo)
    {

        //Cuántos productos mostrar por página
        $productosPorPagina = 5;
        // Por defecto es la página 1; pero si está presente en la URL, tomamos esa
        $pagina = 1;
        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }
        # El límite es el número de productos por página
        $limit = $productosPorPagina;
        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
        $offset = ($pagina - 1) * $productosPorPagina;
        # Necesitamos el conteo para saber cuántas páginas vamos a mostrar
        $sql = "SELECT count(*) AS conteo FROM $tabla";
        $stmt = $this->conn->query($sql);
        $conteo = $stmt->fetchObject()->conteo;
        # Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
        $paginas = ceil($conteo / $productosPorPagina);

        # Ahora obtenemos los productos usando ya el OFFSET y el LIMIT

        if ($tabla == "viviendas") {
            $sqll = "SELECT v.*, GROUP_CONCAT(f.foto SEPARATOR ',') AS nombres_fotos FROM viviendas v 
            LEFT JOIN fotos f ON v.id = f.id_vivienda GROUP BY v.id ORDER BY MAX(v.fecha_anuncio) 
            DESC LIMIT $limit OFFSET $offset";
        } else {

            $sqll = "SELECT * FROM $tabla LIMIT $limit OFFSET $offset";
        }

        $stmt = $this->conn->query($sqll);
        $stmt->execute();

        while ($filas = $stmt->FETCHALL(PDO::FETCH_ASSOC)) {
            $dato[] = $filas;
        }
    }
}
