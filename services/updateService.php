<?php

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    
    $json = [
        "id" => $_POST['id'],
        "service" => $_POST['service']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "http://127.0.0.1/truckdmback/Services/update",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",    							
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