<?php

session_name ("TRUCK");
session_start();
$user = $_SESSION['idSup'];

date_default_timezone_set("America/Mexico_City");
$current = date("Y-m");
$todate =  date("Y-m",strtotime($current)).'-17'; 

$current_month = date("m");



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
                    doc.Date, doc.Url, 
                    DATEDIFF('".$todate."', NOW()) restante 
                FROM `document` AS `doc`
                WHERE ID_Supplier =  ".$user." ORDER BY doc.Date Desc LIMIT 1 ) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);