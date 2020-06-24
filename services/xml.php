<?php 

//error_reporting(0);

if (file_exists('../facturas/ejemplo.xml')) {
   
    libxml_use_internal_errors(true);

    $xml2 = new \SimpleXMLElement('../facturas/ejemplo.xml', null, true);
    $json = json_encode($xml2);
    $array = json_decode($json,TRUE);

    print_r($array);
$total = $array['@attributes']['Total'];
    print_r($array['@attributes']['Total']);
} else {
    exit('Error abriendo test.xml.');
}

?>