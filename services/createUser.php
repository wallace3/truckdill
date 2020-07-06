<?php

	session_name ("TRUCK");
	session_start();

	$actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $json = [
            "username" => $_POST['user'],
            "password" => sha1($_POST['pass']),
            "email" => $_POST['email'],
            "ID_Type" => $_POST['type'],
            "Status"  => 1
    ];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "http://127.0.0.1/truckdmback/User/add",  
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
	$responseJson	= json_decode($response);	

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
    
