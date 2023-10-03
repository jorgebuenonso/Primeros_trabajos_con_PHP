
<?php
require_once("../config.php");
require_once("../modelo/session.php");
require_once("../modelo/indexModelo.php");
require_once("../modelo/vivienda.php");
require_once("../modelo/usuario.php");
require_once("../modelo/foto.php");


// control de entrada de formulario para distintas opciones, segun el valor de la variable se realiza una accion o otra
if (isset($_REQUEST['e'])) {
    modeloController::eliminarFoto($_REQUEST['id'], $_REQUEST['e'], $_REQUEST['idVi']);
}

if (isset($_REQUEST['m'])) :

    switch ($_REQUEST['m']) {
        case 'eliminarV':
            $tabla = "viviendas";
            modeloController::eliminar($tabla);
            break;
        case 'eliminarU':
            $tabla = "usuarios";
            modeloController::eliminar($tabla);
            break;
        case 'usuarios':
            $tabla = "usuarios";
            modeloController::index($tabla);
            break;
        case 'viviendas':
            $tabla = "viviendas";
            modeloController::index($tabla);
            break;
    }

    // control de vista, si no se selecciono una se muestra la principar

    if (method_exists("modeloController", $_REQUEST['m'])) :

        modeloController::{$_REQUEST['m']}();
    endif;

else :
    $tabla = "viviendas";
    modeloController::index($tabla);

endif;

class modeloController
{

    private $model;
    public function __construct()
    {
        $this->model = new Modelo();
    }
    // mostrar
    static function index($tabla)
    {
        $producto   = new Modelo();
        $conn       =   $producto->mostrarIndex();
        $producto->paguinacion($tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
        if ($tabla == "viviendas") {
            require_once("../vista/indexVista.php");
        }
        if ($tabla == "usuarios") {
            require_once("../vista/vistaUsuarios.php");
        }
    }

    //nuevo
    static function nuevoUsuario()
    {
        require_once("../vista/nuevoUsuario.php");
    }

    static function nuevaVivienda()
    {
        require_once("../vista/nuevaVivienda.php");
    }

    // Buscar
    static function buscar()
    {
        require_once("../vista/busquedaVivienda.php");
    }

    //guardar
    static function guardarUsuario()
    {

        $user = new Usuario();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($characters), 0, 5);

        $pass = password_hash($password, PASSWORD_DEFAULT);

        $user->__set('id', $_REQUEST['id']);
        $user->__set('password', $pass);
        $valido = $user->insertar();

        if ($valido == 1) {

            $archivo = fopen("fichero.txt", "a+b");
            fwrite($archivo, "El usuario " . $_REQUEST['id'] . " Se registro con la contraseña: " . $password . " en fecha: " . date("r") . ";<br/>");
            fclose($archivo);

            header("location:../controlador/controller.php?m=usuarios&pass=" . $password);
        } else {
            header("location:../controlador/controller.php?m=usuarios&error= 0");
        }
    }

    static function guardarVivienda()
    {
        // Crea una nueva instancia de la clase Vivienda y Foto
        $house = new Vivienda();
        $file = new Foto();

        // Recoge los datos del formulario utilizando $_REQUEST y asigna a las propiedades del objeto Vivienda
        $house->__set('tipo', $_REQUEST['tipo'] ?? "");
        $house->__set('zona', $_REQUEST['zona'] ?? "");
        $house->__set('dire', $_REQUEST['dire'] ?? "");
        $house->__set('dormi', $_REQUEST['dormi'] ?? "");
        $house->__set('precio', $_REQUEST['precio'] ?? "");
        $house->__set('tamano', $_REQUEST['tamano'] ?? "");
        $house->__set('extras', $_REQUEST['extras'] ?? "");
        $house->__set('obs', $_REQUEST['obs'] ?? "");
        $house->__set('fecha', $_REQUEST['fecha']);

        // Inserta la vivienda en la base de datos y obtiene su ID
        $id = $house->insertar();

        // Guarda las imágenes en la carpeta 'fotos' y actualiza la base de datos con las rutas de las imágenes
        $file->insertar($id);
        foreach ($_FILES['foto']['name'] as $i => $v) {
            move_uploaded_file($_FILES['foto']['tmp_name'][$i], '../fotos/' . $_FILES['foto']['name'][$i]);
        }

        // Redirige a la página de listado de viviendas
        header("location:../controlador/controller.php?m=viviendas");
    }

    static function busqueda()
    {

        $busq = new Vivienda();
        $busq->__set('tipo', $_REQUEST['tipo']);
        $busq->__set('zona', $_REQUEST['zona']);
        $busq->__set('precio', $_REQUEST['precio'] ?? "");
        $busq->__set('dormi', $_REQUEST['dormi'] ?? "");
        $busq->__set('extras', $_REQUEST['extras'] ?? "");

        $datos = $busq->busqueda();

        require_once("../vista/listadoBusqueda.php");
    }


    //editar
    static function editar()
    {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        $dato = $producto->mostrar("viviendas", "id=" . $id);
        require_once("../vista/editar.php");
    }
    //actualizar
    static function actualizar()
    {
        // Crea una nueva instancia de la clase Foto y Vivienda
        $file = new Foto();
        $ado = new Vivienda();

        // Recoge los datos del formulario utilizando $_REQUEST y asigna a las propiedades del objeto Vivienda
        $ado->__set('id', $_REQUEST['id'] ?? "");
        $ado->__set('tipo', $_REQUEST['tipo'] ?? "");
        $ado->__set('zona', $_REQUEST['zona'] ?? "");
        $ado->__set('dire', $_REQUEST['direccion'] ?? "");
        $ado->__set('dormi', $_REQUEST['dormitorio'] ?? "");
        $ado->__set('precio', $_REQUEST['precio'] ?? "");
        $ado->__set('tamano', $_REQUEST['tamano'] ?? "");
        $ado->__set('extras', $_REQUEST['extras'] ?? "");
        $ado->__set('obs', $_REQUEST['observaciones'] ?? "");
        $ado->__set('fecha', $_REQUEST['fecha'] ?? "");

        // Actualiza la vivienda en la base de datos
        $ado->actualizar();

        // Si se han proporcionado nuevas imágenes, actualiza las imágenes asociadas a la vivienda
        if ($_FILES['foto']['size'][0] > 0) {
            $file->insertar($_REQUEST['id']);
            foreach ($_FILES['foto']['name'] as $i => $v) {
                move_uploaded_file($_FILES['foto']['tmp_name'][$i], '../fotos/' . $_FILES['foto']['name'][$i]);
            }
        }

        // Redirige a la página de listado de viviendas
        header("location: ../controlador/controller.php?m=viviendas");
    }


    //eliminar
    static function eliminar($tabla)
    {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        if ($tabla == "viviendas") {
            $dato = $producto->eliminar($tabla, "id=" . $id);
            header("location:" . urlsite);
        } else if ($tabla == "usuarios") {

            $dato = $producto->eliminar($tabla, "id_usuario='" . $id . "'");
            header("location:../controlador/controller.php?m=usuarios");
        }
    }


    static function eliminarFoto($id, $name, $idVi)
    {
        $file = new Foto();
        //echo $id.$name;
        $file->eliminarFoto($id, $name, $idVi);
        header("location:../controlador/controller.php?m=editar&id=$idVi");
    }
}

?>

