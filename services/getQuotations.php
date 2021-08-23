<?php

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];

    $json = [
        "id" => $_POST['id']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $actual_link."/truckdmback/Quotation/getQuotationsNew",  
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
    $responseJson	= json_decode($response);
    curl_close($curl);
    $arr = array();

    $new = [];
    $none = [];

    foreach ($responseJson->data as $key => $item) {
       $arr[$item->Supplier][] = $item;
    }

foreach ($arr as $key => $value) {
    $none[] = $value;
}



    /*$new_array = array();
$exists_array    = array();
foreach( $responseJson->data as $element ) {
    if( !in_array( $element->Supplier, $exists_array )) {
        $exists_array[] = $element->Supplier;
    }
}

    $array_data = array();
    $object = new stdClass();
    foreach($exists_array as $elemento){
        foreach($responseJson->data as $value){
            $object->materials = $value;
            $array_data[] = $object;
        }
    }



    print_r($array_data);die;

    $new_array[] = $element;
    print_r($new_array);die;
    //print_r($response->data)d;die;
    $entrada = array($response['data']);
    $resultado = array_unique($entrada);
    var_dump($resultado);*/



    if($err){
		die(json_encode([
			"status" => 1001,
			"message" => $err
		]));
	}else{
        die(json_encode([
            "status" => 200,
            "message" => "Exito",
            "data" => $none
        ]));
    }



?>