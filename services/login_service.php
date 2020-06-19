<?php

    $json = [
            "email" => $_POST['VALOR'],
            "user" => $_POST['VALOR'],
            "pass" => $_POST['VALOR'];  
    ];



	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "http://127.0.0.1/truckdmback/User/LogIn",  
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
			"status" => 400,
			"message" => $err
		]));
	}else{
		echo $response;
    }
    
