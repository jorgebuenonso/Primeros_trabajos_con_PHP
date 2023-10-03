<?php

  function comprobarExisteEmail($email){
     
// Le pasamos el email del $_REQUEST del controlador
    $url = "http://localhost/Tienda/REST/post.php?email=".$email;    
      
    $json = file_get_contents($url);     
 
    $data = json_decode($json, true);     
                             
     if (json_last_error() !== JSON_ERROR_NONE) {                                 
        echo "Error al decodificar el JSON: " . json_last_error_msg();                               
          echo "<br>";                            
         }                             
         if (json_last_error() === JSON_ERROR_SYNTAX) {    
                 echo 'Error al decodificar el JSON: Syntax error' . json_last_error_msg();  
                echo "<br>";                      
             }         
                
        return $data;  
                     
                     
                   
                    
 }
    
?>