<?php

    require_once('db.php');

    $sql = "SELECT * FROM empleado";

    $req = $bdd->prepare($sql);
    $req->execute();

    $qs = $req->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($qs);



?>