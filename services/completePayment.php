<?php

	session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");
    $current = date("H:i:s");
    
    
	$actual_link = 'http://'.$_SERVER['HTTP_HOST'];

	$json = [
        "ID_Invoice"=>$_POST['ID_Invoice'],
		"invoice"=>$_POST['invoice']
	];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL =>  $actual_link."/truckdmback/Payments/completePayment",  
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

	$response_user = curl_exec($curl);
    $err = curl_error($curl);
	$responseJsonUser = json_decode($response_user);
	print_r($response_user);die;
	
    if($err){
        die(json_encode([
            "status" => 400,
            "message" => $err
        ]));
    }else{
        die(json_encode([
            "status" => 200,
            "message" => "ok"
        ]));
    }

?>
   
    
