<?php 
require_once "../modelo/session.php";
require_once "../modelo/producto.php";
require_once "../modelo/usuario.php";
require_once "../modelo/usuarioDAO.php";
require_once "../modelo/dataSource.php";


if (isset($_REQUEST['m'])){
        Controller::{$_REQUEST['m']}();
    }else{
        Controller::index('producto','true');
    }

    class Controller{

        static function index($tabla,$paginacion){
            $p= new Producto();
            $con= new DataSource($tabla);
            $conn=$con->conexion();
            // $con->paguinacion($tabla, $productosPorPagina, $pagina, $paginas, $dato, $conteo);
            if($tabla=='producto'){
                $sql="SELECT * FROM producto";
                require_once "../vista/indexVista.php";
            }
            
            $dato= $con->consulta($sql,$paginacion);
            
        }

        static function nuevoUsuario(){
            require_once "../vista/registro.php";
        }
        static function nuevoProducto(){
            require_once "../vista/nuevoProducto.php";
        }

        static function guardarProducto(){
            echo "<script> alert('Hubo un error en el proceso de registro. Por favor, inténtalo de nuevo.')</script>";
            $producto = new Producto();
            $tabla_nom = 'producto';
            $tabla = new DataSource($tabla_nom);
            $valores  =array();
            if(isset($_REQUEST['btn']) && isset($_REQUEST['nombre'])){
                   // $dataS= new DataSource();

             $sql = "INSERT INTO producto (Nombre,PVP,Descripcion) VALUES (:nom,:pvp,:des)";

             $producto->__set('nombre', $_REQUEST['nombre']);
             $producto->__set('PVP', $_REQUEST['pvp']);
             $producto->__set('descripcion', $_REQUEST['des']);
         
             $valores=[
                 ':nom' => $producto->__get('nombre'),
                 ':pvp' => $producto->__get('PVP'),
                 ':des' => $producto->__get('descripcion')
             ];
             
             $result= $tabla->ejecutarConsulta($sql,$valores);
             header("Location: ../controlador/controller.php");
             
             if($result==0){
               
                 echo "El producto no se pudo registrar";
                 echo "<script> alert('Hubo un error en el proceso de registro. Por favor, inténtalo de nuevo.')</script>";

                 require_once "../vista/nuevoProducto.php";
             }else{
                header("Location: ../controlador/controller.php");
                 
             }
              }

        }


    static function guardarUsuario()
    {

        if (!empty($_GET['pass']) && !empty($_GET['confiPass'])) {
            if ($_GET['pass'] === $_GET['confiPass']) {
                require_once "../modelo/clienteServicio.php";

                $cliente = new ClienteServicio();
                $tabla_nom = 'usuario';
                $tabla = new DataSource($tabla_nom);
                $valores  = array();

                require_once "../REST/utils.php";

                $usuarioDAO = new UsuarioDAO();
                $comprobarEmail = comprobarExisteEmail($_GET["email"]);
                // print_r($comprobarEmail);
                if ($comprobarEmail) { // Si está vacio, inserta
                    echo "<script>alert('Este usuario ya se encuentra registrado')</script>";
                    require_once "../vista/registro.php";
                } else {

                    $result = $cliente->comprueba($_GET['pass']);

                    if ($result) {
                        if (!empty($_GET['pass']) && !empty($_GET['nombre'])) {

                            $sql = "SELECT count(*) AS 'cantidad' FROM usuario WHERE Email='" . $_GET['email'] . "'";

                            $repetido = $tabla->consulta($sql);

                            if ($repetido[0]['cantidad'] <= 0) {
                                $user = new Usuario();
                                $sql = "INSERT INTO usuario (Nombre,Apellidos,Domicilio,NumTelefono, Email, password) VALUES (:nom,:ape,:domi,:num,:email,:pass)";

                                $pass = password_hash($_GET['pass'], PASSWORD_DEFAULT);

                                $user->__set('nombre', $_GET['nombre']);
                                $user->__set('apellidos', $_GET['ape']);
                                $user->__set('domicilio', $_GET['domi']);
                                $user->__set('numTelefono', $_GET['num']);
                                $user->__set('email', $_GET['email']);
                                $user->__set('password', $pass);

                                $valores = [
                                    ':nom' => $user->__get('nombre'),
                                    ':ape' => $user->__get('apellidos'),
                                    ':domi' => $user->__get('domicilio'),
                                    ':num' => $user->__get('numTelefono'),
                                    ':email' => $user->__get('email'),
                                    ':pass' => $user->__get('password'),
                                ];

                                $result = $tabla->ejecutarConsulta($sql, $valores);

                                header("Location: ../index.php?corU=correcto");
                            } else {
                                echo "<script>alert('Correo ya en uso')</script>";

                                require_once "../vista/registro.php";
                            }
                        } else {
                            echo "<script>alert('Comprete los campos')</script>";
                            require_once "../vista/registro.php";
                        }
                    } else {
                        echo "<script>alert('La contraseña debe cumplir con los siguientes requisitos:\\n- Al menos un número.\\n- Al menos una letra.\\n- Longitud mínima de 8 caracteres.')</script>";

                        require_once "../vista/registro.php";
                    }
                }
            
            }
        } else {
            echo "<script>alert('Comprete los campos')</script>";
            require_once "../vista/registro.php";
        }
    }
}
?>