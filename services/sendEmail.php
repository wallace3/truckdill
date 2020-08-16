<?php

    require_once('phpmailer/PHPMailer.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendEmail($email, $password){
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
    $mail->addAddress($email);
    //$mail->addCustomHeader("BCC: elec.hrdz@gmail.com");

    //Set the subject line
    $mail->Subject = "Cambio Contraseña";

    $mail->DKIM_domain = "truckdm.com.mx";
    $mail->DKIM_identity = "truckdm.com.mx";

    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

    $mail->Body = '<p>Se ha generado una contraseña Temporal, cambiala al iniciar sesión. </p><p>Contraseña Temporal: '.$password.'</p>';

    $mail->IsHTML(true);

    //$mail->addStringAttachment($pdf, 'envioProducto.pdf', 'base64', 'application/pdf');

    //send the message, check for errors
    if (!$mail->send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Enviado';
    }
}

?>