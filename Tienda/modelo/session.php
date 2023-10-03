   

<?php 
    session_start();
    if(empty($_SESSION['usuario'])){
        header("Location:../modelo/logout.php");
    }else{
        echo "<div class='option'>Bienvenido ".$_SESSION['usuario']."<br>";
        echo "<a href='../modelo/logout.php'>Cerrar sesión</a></br></div>";
    }
?>