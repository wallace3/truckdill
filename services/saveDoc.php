<?php


    // Include Composer autoloader if not already done.
    include '../vendor/autoload.php';

    $parser = new \Smalot\PdfParser\Parser();
    
    // Parse pdf file and build necessary objects.
    


    session_name ("TRUCK");
    session_start();
    date_default_timezone_set("America/Mexico_City");

    $current = date("Y-m-d");
    $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
    $user = $_SESSION['idSup'];
    $folder = $_SESSION['userName'];
    

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
        
        
        $pdflink = $actual_link.'/services/docs/'.$folder.'/'.$_FILES['file']['name'];

        $pdf    = $parser->parseFile($pdflink);
        
        $text = $pdf->getText();

        $details  = $pdf->getDetails();
 
        $newDate = date("Y-m-d H:i:s", strtotime($details['CreationDate']));

        $json = [
            "ID_Supplier" => $user,
            "Date" => $newDate,
            "Url" => $actual_link.'/services/docs/'.$folder.'/'.$_FILES['file']['name']
        ];


	    $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $actual_link."/truckdmback/Documents/add",  
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
    }


    //print_r($_FILES['file']);

?>