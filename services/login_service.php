<?php

	session_name ("TRUCK");
	session_start();

    $json = [
            "user" => $_POST['username'],
            "pass" => $_POST['password']
    ];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "http://127.0.0.1/truckdmback/User/login",  
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
	echo $response;
	$responseJson	= json_decode($response);	
	print_r($responseJson->data[0]->Username) ;


	curl_close($curl);



	//echo $variable;
	//var_dump($http_response_header);
	//$prueba = json_encode($response);
	//echo $prueba;
//echo $response;





//echo $response->status;

//echo $response->data[0];


exit();
	/*if (password_verify($_POST['password'], $response->data[0]->password)){
		echo "hola si entro";
		$_SESSION['idUsuario'] = $response->data[0]->ID_User;
		$_SESSION['userName'] = $response->data[0]->Username;
		$_SESSION['email'] = $response->data[0]->Email;
		$_SESSION['idType'] = $response->data[0]->ID_Type;
		$_SESSION['tipo'] = $response->data[0]->Type;
	}*/

	if($err){
		die(json_encode([
			"status" => 400,
			"message" => $err
		]));
	}else{
		echo $response;
    }
    
