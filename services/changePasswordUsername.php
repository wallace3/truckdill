<?php

    require_once('sendEmail.php')

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $json = [
        "email" => $_POST['email']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/User/getUserbyEmail",  
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
    curl_close($curl);
    $responseJson = json_decode($response);

        if($responseJson->status == 204){
            die(json_encode([
                "status" => 1002,
                "message" => "No existe registro con email ingresado"
            ]));die;
        }else{

            $random = randomPassword();

            $json = [
                "username" => $_POST['email'],
                "pass" => $random
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => $actual_link."/truckdmback/User/changePasswordUsername",  
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
                sendEmail($_POST['email'],$random);
                die(json_encode([
                    "status" => 200,
                    "message" => "Exito"
                ]));
            }

        }
  
    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

?>