<?php

	session_name ("TRUCK");
	session_start();

	$actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $json = [
            "user" => $_POST['username'],
            "pass" => $_POST['password']
    ];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => $actual_link."/truckdmback/User/login",  
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
	curl_close($curl);

	if((sha1($_POST['password']) == $responseJson->data[0]->Password) && $responseJson->data[0]->Status == 1)
	{
		$_SESSION['idUsuario'] = $responseJson->data[0]->ID_User;
		$_SESSION['userName'] = $responseJson->data[0]->Username;
		$_SESSION['email'] = $responseJson->data[0]->Email;
		$_SESSION['idType'] = $responseJson->data[0]->ID_Type;
		$_SESSION['tipo'] = $responseJson->data[0]->Type;
		
		if($responseJson->data[0]->ID_Type == 4){
			$json = [
				"id" => $responseJson->data[0]->ID_User
			];
			$curl = curl_init();
			curl_setopt_array($curl, [
				CURLOPT_URL => "http://127.0.0.1/truckdmback/Supplier/getSupplierbyId",  
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",    							
				CURLOPT_POSTFIELDS => json_encode($json),                       
				CURLOPT_HTTPHEADER => [
					"Content-Type: application/json",
					"cache-control: no-cache"
				]
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);
			$responseSup = json_decode($response);
			curl_close($curl);

			$_SESSION['idSup'] = $responseSup->data[0]->ID_Supplier;
			$_SESSION['Sup'] = $responseSup->data[0]->Supplier;	
			$_SESSION['rfc'] = $responseSup->data[0]->Rfc;	
			$_SESSION['legal'] = $responseSup->data[0]->Legal;	

			
		}
		die(json_encode([
			"status" => 200,
			"message" => "Sesion Iniciada"
		]));
	
	}else{
		die(json_encode([
			"status" => 1002,
			"message" => "Password Incorrecto o Usuario Inhabilitado"
		]));
	}

	if($err){
		die(json_encode([
			"status" => 1001,
			"message" => $err
		]));
	}
