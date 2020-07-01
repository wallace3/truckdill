<?php

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
$table = 'suppliers';

// Table's primary key
$primaryKey = 'ID_Supplier';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`x`.`supplier`', 'dt' => 0, 'field' => 'supplier' ),
	array( 'db' => '`x`.`servs`',   'dt' => 1, 'field' => 'servs' ),
    array( 'db' => '`x`.`legal`',  'dt' => 2, 'field' => 'legal' ),
    array( 'db' => '`x`.`rfc`',  'dt' => 3, 'field' => 'rfc' )
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

$joinQuery = "FROM(
    SELECT sup.Supplier supplier, sup.Rfc rfc, sup.Legal legal, GROUP_CONCAT(serv.Service) servs FROM `suppliers` AS `sup` 
    JOIN `users` AS `us` ON (`us`.`ID_User` = `sup`.`ID_User`) 
    LEFT JOIN `suppliers_has_services` AS `sups` ON (`sups`.`ID_Supplier` = `sup`.`ID_Supplier`) 
    LEFT JOIN `services` AS `serv` ON (`serv`.`ID_Service` = `sups`.`ID_Service`) 
    WHERE `us`.`Status` = 1 GROUP BY sup.ID_Supplier
) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);