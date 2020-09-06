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
    array( 'db' => '`x`.`Supplier`', 'dt' => 1, 'field' => 'Supplier' ),
    array( 'db' => '`x`.`Description`',  'dt' => 2, 'field' => 'Description'),
    array( 'db' => '`x`.`Company`',  'dt' => 3, 'field' => 'Company'),
    array( 'db' => '`x`.`Rfc`', 'dt' => 4, 'field' => 'Rfc' ),
	array( 'db' => '`x`.`Date_Upload`',   'dt' => 5, 'field' => 'Date_Upload' ),
    array( 'db' => '`x`.`Amount`',  'dt' => 6, 'field' => 'Amount' ),
    array( 'db' => '`x`.`Date`',  'dt' => 7, 'field' => 'Date' ),
    array( 'db' => '`x`.`statusText`',  'dt' => 8, 'field' => 'statusText'),
    array( 'db' => '`x`.`restante`',  'dt' => 9, 'field' => 'restante'),
    array( 'db' => '`x`.`ID_Supplier`',  'dt' => 10, 'field' => 'ID_Supplier'),
    array( 'db' => '`x`.`ID_Invoice`',  'dt' => 11, 'field' => 'ID_Invoice'),
    array( 'db' => '`x`.`Url`',  'dt' => 12, 'field' => 'Url'),
    array( 'db' => '`x`.`Status`',  'dt' => 13, 'field' => 'Status')
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

$joinQuery = "FROM (
                SELECT 
                    i.Description, 
                    com.Url, 
                    i.Company, 
                    i.Date_Upload, 
                    i.Status, 
                    i.ID_Supplier, 
                    i.ID_Invoice, 
                    i.Amount, 
                    i.Date, 
                    s.Supplier, 
                    s.Rfc, 
                    COALESCE(ROUND(SUM(ps.Amount),2), 0) restante,
                    IF(i.Status = 0, 'Cancelada', IF(i.Status = 2, 'Completada', 'Pendiente')) statusText
                FROM invoices i
                JOIN suppliers s ON s.ID_Supplier = i.ID_Supplier
                LEFT JOIN payments_to_supplier ps ON ps.ID_Invoice = i.ID_Invoice
                LEFT JOIN complements com ON com.ID_Invoice = i.ID_Invoice
                WHERE i.Status = 2
                GROUP BY i.ID_Invoice) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);