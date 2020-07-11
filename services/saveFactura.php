<?php

    session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");

    $current = date("Y-m-d");
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $user = $_SESSION['idSup'];
    $folder = $_SESSION['userName'];
    $formats = [];

    if (!file_exists('docs/'.$folder.'')) {
        mkdir('docs/'.$folder.'', 0755, true);
    }

    if(sizeof($_FILES) > 2 || sizeof($_FILES) < 2){
        die(json_encode([
            "status" => 1007,
            "message" => "Ingresa dos archivos"
        ]));
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

    if(in_array('text/xml',$formats)){
        foreach($_FILES as $file){
            if($file['type']=='text/xml'){
                move_uploaded_file($file['tmp_name'], 'docs/'.$folder.'/' . $file['name']);
                libxml_use_internal_errors(true);
                $link =  $actual_link.'/truckdill/services/docs/'.$folder.'/'.$file['name'];
                $xml2 = new \SimpleXMLElement($link, null, true);
                $json = json_encode($xml2);
                $array = json_decode($json,TRUE);
                $GLOBALS['amount'] = $array['@attributes']['Total'];
                $GLOBALS['fecha'] = $array['@attributes']['Fecha'];
            }else{
                move_uploaded_file($file['tmp_name'], 'docs/'.$folder.'/' . $file['name']);
                $link2 =  $actual_link.'/truckdill/services/docs/'.$folder.'/'.$file['name'];
                $GLOBALS['link2'] = $link2;
            }
        }
    }else{
        die(json_encode([
            "status" => 1006,
            "message" => "Ocurrio un error no hay xml"
        ]));
    }

    $json = [
        "ID_Supplier" => $user,
        "Amount" => $GLOBALS['amount'],
        "Description" => "",
        "Date" =>  $GLOBALS['fecha'],
        "Status" => 1,
        "Url" => $GLOBALS['link2'],
        "Date_Upload" => $current = date("Y-m-d H:i:s")
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "http://127.0.0.1/truckdmback/Invoices/add",  
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