<?php 

    require_once "../modelo/dataSource.php";
    require_once "../modelo/producto.php";
    $source= new DataSource('producto');

 if(!isset($_SESSION['carro'])) {
    $_SESSION['carro'] = array();
  }

$precio_total=0;
if(isset($_REQUEST['agregar'])){
    //print_r($_REQUEST['plato']);
    if(isset($_REQUEST['producto'])){
       
        foreach($_REQUEST['producto'] as $producto=>$precio){
               
            if(isset($_SESSION['carro'][$producto])){
                 //print_r($_SESSION['carro']);
                 // si el plato ya esta en el carro le sumamos uno
                $_SESSION['carro'][$producto]['cantidad']++;
                //Actualizamos carro
                $_SESSION['carro'][$producto]['precio']= $precio * $_SESSION['carro'][$producto]['cantidad'];
            }else{
                //si el producto no esta se añade
                $_SESSION['carro'][$producto] = [
                    'precio'=>$precio,
                    'cantidad'=>1
                ];
            }
        }
        
    }else{
        // header("Location:carta.php");
    }
   
}

if(isset($_REQUEST['borrar'])){
    foreach($_REQUEST['producto'] as $producto => $precio){
        //verificamos si el producto esta en el carro
        if(isset($_SESSION['carro'][$producto])){
            // si el plato ya esta en el carro restamos uno
            $_SESSION['carro'][$producto]['cantidad']--;
            //Actualizamos el precio total
            $precio_total -= $precio;
            $_SESSION['carro'][$producto]['precio'] = $_SESSION['carro'][$producto]['cantidad'] * $precio;
            //si la cantidad es 0 eliminamos el producto
            if($_SESSION['carro'][$producto]['cantidad'] == 0){
                unset($_SESSION['carro'][$producto]);
            }
        }
    }
}


if(isset($_REQUEST['vaciar'])){
    unset($_SESSION['carro']);
    $precio_total = 0;
}

if(isset($_REQUEST['borrarT'])){
    // require_once "../modelo/dataSource.php";
    // $source= new DataSource('producto');

    $sql= "DELETE FROM producto WHERE codProd=".$_REQUEST['cod'];

    $source->consulta($sql);
    header("Location: ../controlador/controller.php");
}

if(isset($_REQUEST['modificar'])){
     unset($_SESSION['carro']);
     $precio_total = 0;
     
     $sql = "SELECT * FROM producto WHERE codProd=".$_REQUEST['codP'];
     $dat = $source->consulta($sql);
     require_once "../vista/editarProducto.php";

}
if(isset($_REQUEST['actualizar'])){

    $producto = new Producto();
  
    $sql = "UPDATE producto SET  Nombre= :nom, PVP= :pvp, Descripcion= :des WHERE codProd=".$_REQUEST['codProd'];

    $producto->__set('nombre', $_REQUEST['Nombre']??"");
    $producto->__set('PVP', $_REQUEST['PVP']??"");
    $producto->__set('descripcion', $_REQUEST['Descripcion']??"");

    $valores=[
        ':nom' => $producto->__get('nombre'),
        ':pvp' => $producto->__get('PVP'),
        ':des' => $producto->__get('descripcion')
    ];
    
    $source->ejecutarConsulta($sql,$valores);
    header("Location: ../controlador/controller.php");
   
}

if(isset($_SESSION['carro']) && count($_SESSION['carro']) >= 1){
    
    // Obtener la cantidad de veces que se ha seleccionado cada producto
    $seleccionados = array();
    foreach($_SESSION['carro'] as $producto=>$detalles){
        $seleccionados[$producto] = $detalles['cantidad'];
    }

    // Ordenar los productos de mayor a menor según la cantidad de veces seleccionados
    arsort($seleccionados);
    
    // Tomar los 3 productos más seleccionados y guardarlos en una cookie
    $productosMasSeleccionados = array_slice($seleccionados, 0, 3, true);
    setcookie('productosMasSeleccionados', json_encode($productosMasSeleccionados), time() + (86400 * 30), '/'); // 86400 = 1 día
    
    // Mostrar los 3 productos más seleccionados
    
    echo "Los 3 productos más seleccionados son:<br>";

    if(isset($_COOKIE['productosMasSeleccionados'])) {
        $productos_seleccionados = json_decode($_COOKIE['productosMasSeleccionados'], true);
        if(count($productos_seleccionados) > 0) {
            foreach($productos_seleccionados as $producto => $cantidad) {
                // Aquí puedes mostrar el producto y la cantidad
                echo "Producto: " . $producto . ", Cantidad: " . $cantidad . "<br>";
            }
        } else {
            echo "No hay productos seleccionados";
        }
    } else {
        echo "No se encontró la cookie de productos seleccionados";
    }
    
}

// Verificar si hay elementos en el carrito

?>