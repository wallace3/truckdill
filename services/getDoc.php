<?php

session_name ("TRUCK");
session_start();
$user = $_SESSION['idSup'];
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];

date_default_timezone_set("America/Mexico_City");
$current = date("Y-m");
$todate =  date("Y-m",strtotime($current)).'-17'; 

$current_month = date("m");

$json = [
    "id" => $user
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Documents/getDocbyIdSup",  
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

if($responseJson->status == 200){
    $dateDocument = $responseJson->data[0]->Date;
    $createDate = new DateTime($dateDocument);
    $newDateDoc = $createDate->format('Y-m-d');

    if($current_month > date_format(new DateTime($newDateDoc),"m")){
        $dias = 0;
    }elseif ($current_month == date_format(new DateTime($newDateDoc),"m")) {
        if(date_format(new DateTime($newDateDoc),"d") <= 17){
            $dias = 17 - date_format(new DateTime($newDateDoc),"d");
        }else{
            $dias = 17 - date_format(new DateTime($newDateDoc),"d");
        }
    }
}

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'document';

// Table's primary key
$primaryKey = 'ID_Document';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`x`.`Date`',   'dt' => 0, 'field' => 'Date' ),
    array( 'db' => '`x`.`Url`',  'dt' => 1, 'field' => 'Url' ),
    array( 'db' => '`x`.`restante`',  'dt' => 2, 'field' => 'restante' ),
    array( 'db' => '`x`.`ID_Document`',  'dt' => 3, 'field' => 'ID_Document' ),
    array( 'db' => '`x`.`ID_Supplier`',  'dt' => 4, 'field' => 'ID_Supplier' ),

);

// SQL server connection information
//require('config.php');
if($_SERVER['HTTP_HOST'] == 'localhost'){
    $sql_details = array(
        'user' => 'root',
        'pass' => '',
        'db'   => 'truckdm',
        'host' => 'localhost'
    );
}else{
    $sql_details = array(
        'user' => 'dbu138194',
        'pass' => 'f!Y#rm)xo+7=*',
        'db'   => 'dbs519076',
        'host' => 'db5000540604.hosting-data.io'
    );
}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

//SELECT *, GROUP_CONCAT(serv.Service) servs

$joinQuery = "FROM(
                SELECT 
                    doc.ID_Document, 
                    doc.ID_Supplier, 
                    doc.Date, 
                    doc.Url, 
                    ".$dias." restante 
                FROM `document` AS `doc`
                WHERE ID_Supplier =  ".$user." ORDER BY doc.Date Desc LIMIT 1 ) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);

?>