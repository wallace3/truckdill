<?php

    session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");

    $current = date("Y-m-d H:i:s");
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $user = $_SESSION['idSup'];
    $folder = $_SESSION['userName'];
    $formats = [];

    if (!file_exists('docs/'.$folder.'')) {
        mkdir('docs/'.$folder.'', 0755, true);
    }

    foreach($_FILES as $file){
        if($file['type'] != 'application/pdf' && $file['type'] != 'text/xml'){
            die(json_encode([
                "status" => 1005,
                "message" => "Ingresa formato xml o pdf"
            ]));
        }else{
            array_push($formats,$file['type']);
        }
    }

    foreach($_FILES as $file){
        move_uploaded_file($file['tmp_name'], 'docs/'.$folder.'/' . $file['name']);
        $link2 =  $actual_link.'/truckdill/services/docs/'.$folder.'/'.$file['name'];
        $GLOBALS['link2'] = $link2;
    }

    $json = [
        "ID_Invoice" => $_POST['idInvoice'],
        "Cancel_Date" => $current,
        "Url" => $GLOBALS['link2']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $actual_link."/truckdmback/Invoices/rejectInvoice",  
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

?>