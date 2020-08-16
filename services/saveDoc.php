<?php

    session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");

    $current = date("Y-m-d");
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $user = $_SESSION['idSup'];
    $folder = $_SESSION['userName'];
    
    if($_FILES['file']['type'] != 'application/pdf'){
        die(json_encode([
            "status" => 1005,
            "message" => "Ingresa Formato PDF"
        ]));
    }

    if (!file_exists('docs/'.$folder.'')) {
        mkdir('docs/'.$folder.'', 0755, true);
        $action = "add";
        $method = "POST";
    }else{
        $action = "update";
        $method = "PUT";
    }

    if (0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else 
    {
        move_uploaded_file($_FILES['file']['tmp_name'], 'docs/'.$folder.'/' . $_FILES['file']['name']);
        
        $json = [
            "ID_Supplier" => $user,
            "Date" => $current = date("Y-m-d H:i:s"),
            "Url" => $actual_link.'/truckdill/services/docs/'.$folder.'/'.$_FILES['file']['name']
        ];

	    $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $actualink."/truckdmback/Documents/".$action,  
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,    							
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
    }


    //print_r($_FILES['file']);

?>