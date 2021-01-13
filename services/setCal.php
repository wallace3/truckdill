<?php

    require_once('db.php');
    date_default_timezone_set("America/Mexico_City");
    $id=$_POST['id'];
    $cal=$_POST['cal'];

    $sql_empleado = "UPDATE `respuestas` SET `Calificacion` = $cal WHERE `respuestas`.`idRespuesta` = $id";
    $query = $bdd->prepare( $sql_empleado );

	if ($query == false) {
	   // print_r($bdd->errorInfo());
        die(json_encode([
            "status" => 400,
            "message" => "Error"
        ]));
	}
	$sth = $query->execute();
	if ($sth == false) {
	    //print_r($query->errorInfo());
        die(json_encode([
            "status" => 400,
            "message" => "Error"
        ]));
    }

    die(json_encode([
        "status" => 200,
        "message" => "Exito"
    ]));

?>

