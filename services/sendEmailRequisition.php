<?php

    require_once('phpmailer/PHPMailer.php');
   

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function saveQs($idr,$url,$ids){
        date_default_timezone_set("America/Mexico_City");
        $current = date("Y-m-d H:i:s");
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'];
        foreach ($ids as $value) {
            
            $curl = curl_init();

            $json = [
                "ID_Requisition" => $idr,
                "ID_Supplier" => $value,
                "Url" => $url,
                "Date" => $current,
                "Status" => 1
            ];
    
            curl_setopt_array($curl, [
                CURLOPT_URL => $actual_link."/truckdmback/Quotation/add",  
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
        
        }
    }

    function sendEmailRequisition($suppliers,$url){

        foreach ($suppliers as $key => $value) {
   
            //Create a new PHPMailer instance
            $mail = new PHPMailer;

            //Tell PHPMailer to use SMTP
            $mail->isSendMail();

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 3;

            $mail->Timeout=60;

            $mail->Helo = "administracion.truckdm.com.mx"; //Muy importante para que llegue a hotmail y otros

            //Set the hostname of the mail server
            $mail->Host = 'smtp.1and1.mx';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "noreply@truckdm.com.mx";

            //Password to use for SMTP authentication
            $mail->Password = "Noreplyqwerty1;";

            //Set who the message is to be sent from
            $mail->setFrom('noreply@truckdm.com.mx', 'Administracion');

            //Set an alternative reply-to address
            //$mail->addReplyTo($email, 'Bodega');

            //Set who the message is to be sent to
            $mail->addAddress($value);
            $archivo = 'https://administracion.truckdm.com.mx/services/documents/solicitud-cotizacion.pdf';
            $fichero = file_get_contents($archivo);
            $mail->addStringAttachment($fichero, 'solicitud-cotizacion.pdf');
            //$mail->addCustomHeader("BCC: elec.hrdz@gmail.com");

            //Set the subject line
            $mail->Subject = "Envio Requisicion";

            $mail->DKIM_domain = "truckdm.com.mx";
            $mail->DKIM_identity = "truckdm.com.mx";

            //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

            $mail->Body = '<p>TDM GROUP le ha solicitdado cotización de la requisición que se encuentra en la siguiente liga: </p><p> '.$url.'</p>';

            $mail->IsHTML(true);

            //$mail->addStringAttachment($pdf, 'envioProducto.pdf', 'base64', 'application/pdf');

            //send the message, check for errors
            if (!$mail->send()) {
                return $mail->ErrorInfo;
            } else {
                return 'Enviado';
            }

        }
    }
    
?>