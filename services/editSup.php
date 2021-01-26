<?php

    session_name('TRUCK');
    session_start();
    if(!isset($_SESSION['idUsuario']) || empty($_SESSION)){
        header("Location: login.php");
    }
 

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    
    $json = [
        "id" => $_POST['idSup'],
        "params" => [
            "Supplier" => $_POST['sup'],
            "Rfc" => $_POST['rfc'],
            "Legal" => $_POST['legal'],
            "ID_Enterprise" => $_POST['enterprise']
        ]
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Supplier/update",  
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