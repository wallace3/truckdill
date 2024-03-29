<?php

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    date_default_timezone_set("America/Mexico_City");
    $current = date("H:i:s");
    $date = $_POST['date'].' '.$current;
    $json = [
        "ID_Invoice" => $_POST['id'],
        "Amount"  => $_POST['amount'],
        "ID_Supplier" => $_POST['idSup'],
        "Date" => $date
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Payments/addPayment",  
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