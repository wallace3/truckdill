<?php

    session_name ("TRUCK");
    session_start();
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $actual_link."/truckdmback/Drills/getEnterprises",  
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",                       
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "cache-control: no-cache"
        ]
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $responseJson	= json_decode($response);
    curl_close($curl);

    if($err){
		die(json_encode([
			"status" => 1001,
			"message" => $err
		]));
	}else{
        die(json_encode([
            "status" => 200,
            "message" => "Exito",
            "data" => $responseJson
        ]));
    }



?>