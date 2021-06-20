<?php

    date_default_timezone_set("America/Mexico_City");
    $current = date("Y-m-d H:i:s");
    $today=date('Y-m-d');
    session_name ("TRUCK");
    session_start();
    $req_date=date('Y-m-d', strtotime($today. ' + 20 days'));
    $req_date = $req_date.' '.date('H:i:s');

    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $materiales= [];
    $proyecto = [];

    foreach($_POST['materiales'] as $s){
        //print_r($s);die;
        array_push($materiales, array('Partida' => $s[0], 'Cantidad'=>$s[1], 'Unidad'=>$s[2],'Descripcion'=>$s[3],'PrecioU'=>$s[4],"TotalU"=>$s[5]));
    }

    array_push($proyecto,array('Depto'=>$_POST['depto'],'Folio'=>$_POST['folio'],'Cgo'=>"",'ID_User'=>$_SESSION['idUsuario'],'Project'=>$_POST['proyecto'], 'Equipment'=>$_POST['equipo'], 'Supplier'=>$_POST['proveedor'], 'Deliver'=>$_POST['lugar'], 'Payment_Conditions'=>$_POST['condiciones'], 'Deliver_Conditions'=>$_POST['entrega'], 'Subtotal'=>$_POST['subtotal'], 'IVA'=>$_POST['iva'], 'Total'=>$_POST['total'], 'Limit_Date'=>$req_date,'Status'=>1,'Emision_Date'=>$current ));

    $newobj = new stdClass();
    $newobj->info = $proyecto;
    $newobj->materials = $materiales;

    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL =>  $actual_link."/truckdmback/Requisitions/addOc",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",    							
    CURLOPT_POSTFIELDS => json_encode($newobj),                       
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // PETICIÓN PARA OBTENER MATERIALES
$json2=[
    "id" => $_POST['cot']
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Quotation/acceptQ",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",    
    CURLOPT_POSTFIELDS => json_encode($json2),                     
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);


    //print_r($response);

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