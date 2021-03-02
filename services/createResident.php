<?php

	session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");
    
	$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $json = [
        "user" => [
            "Username"=>$_POST['user'],
            "Password" => sha1($_POST['pass']),
            "Email"=>$_POST['email'],
            "ID_Type"=>3,
            "Status"=>1
        ],
        "resident" => [
            "Name"=>$_POST['name'],
            "Phone"=>$_POST['tel'],
            "ID_Drill"=>$_POST['um'],
            "Status"=>1
        ]
    ];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL =>  $actual_link."/truckdmback/Residents/createResident",  
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

	$response_user = curl_exec($curl);
    $err = curl_error($curl);
	$responseJsonUser = json_decode($response_user);
	
    if($err){
        die(json_encode([
            "status" => 400,
            "message" => $err
        ]));
    }else{
        die(json_encode([
            "status" => 200,
            "message" => "ok",
            "data" => $responseJsonUser
        ]));
    }

?>
   
    
