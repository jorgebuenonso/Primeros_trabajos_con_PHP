<?php 

class Contrasena {
    public function compruebacontra($pass) {
        $formato = preg_match('/(?=\w*\d)(?=\w*[A-z])\S{8,}/', $pass);
        return $formato == 1;
    }
}


    // Esta función comprueba si una cadena de caracteres cumple con ciertos 
    // requisitos de formato para ser considerada como una contraseña segura.

    // En particular, la función utiliza una expresión regular para verificar 
    // si la cadena contiene al menos 8 caracteres, al menos un número y al menos una letra.

    // Si la cadena cumple con estos requisitos, la función devuelve True, lo 
    // que indica que la contraseña es segura. Si la cadena no cumple con estos 
    // requisitos, la función devuelve False, lo que indica que la contraseña no es segura.

    // public function compruebacontra($contra){
    //     try {
    //         $comprobar = false;
    //         if(strlen($contra) >= 8){
    //             for($i =  count($contra)-1; $i >= 0;$i--){
    //                 if($contra[$i] =="0" || $contra[$i] =="1" || $contra[$i] =="2" || $contra[$i] =="3" || $contra[$i] =="4" || $contra[$i] =="5" || $contra[$i] =="6" || $contra[$i] =="7" || $contra[$i] =="8" || $contra[$i] =="9"){
    //                     $comprobar = true;
    //                 }
    //             }
    //         }
    //         return $comprobar;
    //     }catch(PDOException $e){
    //         die("Error:". $e->getMessage());
    //     }
    // }


?>