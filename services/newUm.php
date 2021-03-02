<?php

    date_default_timezone_set("America/Mexico_City");
    $current = date("Y-m-d H:i:s");
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $json = [
        "Name" => $_POST['name'],
        "ID_Enterprise"=> $_POST['enterprise'],
        "Status" => 1,
        "Date" => $current
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Drills/add",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",    							
    CURLOPT_POSTFIELDS => json_encode($json),                       
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

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