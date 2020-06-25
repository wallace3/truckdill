
<?php 

    
    session_name ("TRUCK");
    session_start();
    //print_r($_SESSION);
    
    if(!isset($_SESSION['idUsuario'])){
        header("Location: login.php");
    }

?>