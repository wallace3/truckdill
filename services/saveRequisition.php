<?php

    date_default_timezone_set("America/Mexico_City");
    $current = date("Y-m-d H:i:s");
    $today=date('Y-m-d');
    session_name ("TRUCK");
    session_start();
    $idResident = $_SESSION['idResident'];
    $name = $_SESSION['name'];	
    $phone = $_SESSION['phone'];	
    $drill = $_SESSION['iddrill'];
    $req_date=date('Y-m-d', strtotime($today. ' + 20 days'));
    $req_date = $req_date.' '.date('H:i:s');

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $materiales= [];
    $proyecto = [];

    foreach($_POST['materiales'] as $s){
        array_push($materiales, array('Partida' => $s[0], 'Marca'=>$s[1], 'Modelo'=>$s[2],'Descripcion'=>$s[3],'Cantidad'=>$s[4],'Unidad'=>$s[5],"Area"=>$s[6]));
    }

    array_push($proyecto,array('Project'=>$_POST['proyecto'],'Equipment'=>$_POST['equipo'],'Number'=>$_POST['economico'],'Emition_Date'=>$current,'Required_Date'=>$req_date,'Folio'=>$_POST['folio'], 'Depto'=>$_POST['depto'],'Observations'=>$_POST['observaciones'],'Justification'=>$_POST['justificacion'],'Employee'=>$name,'ID_Resident'=>$idResident,'ID_Drill'=>$drill,'Status'=>1,'Date'=>$current ));

    $newobj = new stdClass();
    $newobj->info = $proyecto;
    $newobj->materials = $materiales;

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL =>  $actual_link."/truckdmback/Requisitions/addRequisition",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",    							
    CURLOPT_POSTFIELDS => json_encode($newobj),                       
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    //print_r($response);

    if($err){
		die(json_encode([
			"status" => 1001,
			"message" => $err
		]));
	}else{
        die(json_encode([
			"status" => 200,
			"message" => "Exito"
		]));
    }
?>