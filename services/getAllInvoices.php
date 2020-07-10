<?php

session_name ("TRUCK");
session_start();


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
    array( 'db' => '`x`.`Supplier`', 'dt' => 0, 'field' => 'Supplier' ),
    array( 'db' => '`x`.`Rfc`', 'dt' => 1, 'field' => 'Rfc' ),
	array( 'db' => '`x`.`Date_Upload`',   'dt' => 2, 'field' => 'Date_Upload' ),
    array( 'db' => '`x`.`Amount`',  'dt' => 3, 'field' => 'Amount' ),
    array( 'db' => '`x`.`Date`',  'dt' => 4, 'field' => 'Date' ),
    array( 'db' => '`x`.`Status`',  'dt' => 5, 'field' => 'Status'),
    array( 'db' => '`x`.`restante`',  'dt' => 6, 'field' => 'restante'),
    array( 'db' => '`x`.`ID_Supplier`',  'dt' => 7, 'field' => 'ID_Supplier'),
    array( 'db' => '`x`.`ID_Invoice`',  'dt' => 8, 'field' => 'ID_Invoice'),
    array( 'db' => '`x`.`Url`',  'dt' => 9, 'field' => 'Url'),
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

$joinQuery = "FROM (
                SELECT i.Description, i.Url, i.Date_Upload, i.Status, i.ID_Supplier, i.ID_Invoice, i.Amount, i.Date, s.Supplier, s.Rfc, COALESCE(ROUND(SUM(ps.Amount),2), 0) restante
                FROM invoices i
                JOIN suppliers s ON s.ID_Supplier = i.ID_Supplier
                LEFT JOIN payments_to_supplier ps ON ps.ID_Invoice = i.ID_Invoice
                GROUP BY i.ID_Invoice) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);