<?php

    require_once('phpmailer/PHPMailer.php');
    require_once('sendEmailRequisition.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    sendEmailRequisition($_POST['suppliers'],$_POST['url']);
    saveQs($_POST['idRequisition'],$_POST['url'],$_POST['ids']);

    die(json_encode([
        "status" => 200,
        "message" => "Exito"
    ]));
  
?>