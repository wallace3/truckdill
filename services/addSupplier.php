<?php

    date_default_timezone_set("America/Mexico_City");
    $current = date("Y-m-d H:i:s");
    $services = [];

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    foreach($_POST['services'] as $s){
        array_push($services, array('ID_Service' => $s));
    }

    $jsons = json_encode($services);
   
    $user = [
        "username" => $_POST['user'],
        "password" => sha1($_POST['password']),
        "email" => $_POST['email'],
        "ID_Type" => 4,
        "Status" =>1
    ];

    $sup = [
        "Supplier" => $_POST['supplier'],
        "rfc" => $_POST['rfc'],
        "legal" => $_POST['legal']
    ];

    $newobj = new stdClass();
    $newobj->user = $user;
    $newobj->sup = $sup;
    $newobj->services = $services;

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => "http://127.0.0.1/truckdmback/Supplier/addSupplier",  
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

    if($err){
		die(json_encode([
			"status" => 1001,
			"message" => $err
		]));
	}else{
        die(json_encode([
			"status" => 200,
            "message" => "Exito",
            "data" => json_decode($response)
		]));
    }

?>