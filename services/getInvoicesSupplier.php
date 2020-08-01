<?php

session_name ("TRUCK");
session_start();
$idsup = $_SESSION['idSup'];

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
$table = 'invoices';

// Table's primary key
$primaryKey = 'ID_Supplier';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`i`.`Description`', 'dt' => 0, 'field' => 'Description' ),
    array( 'db' => '`i`.`Company`',  'dt' => 1, 'field' => 'Company' ),
    array( 'db' => '`i`.`Description`', 'dt' => 2, 'field' => 'Description' ),
	array( 'db' => '`i`.`Amount`',   'dt' => 3, 'field' => 'Amount' ),
    array( 'db' => '`i`.`Date`',  'dt' => 4, 'field' => 'Date' ),
    array( 'db' => '`i`.`Status`',  'dt' => 5, 'field' => 'Status' ),
    array( 'db' => '`i`.`ID_Invoice`',  'dt' => 6, 'field' => 'ID_Invoice' ),
);

// SQL server connection information
//require('config.php');
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'truckdm',
    'host' => 'localhost'
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

//SELECT *, GROUP_CONCAT(serv.Service) servs

$joinQuery = "FROM `invoices` AS `i`";
$extraWhere = "`i`.`ID_Supplier` = $idsup";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);