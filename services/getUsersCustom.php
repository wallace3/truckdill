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
$table = 'users';

// Table's primary key
$primaryKey = 'ID_User';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`u`.`Username`', 'dt' => 0, 'field' => 'Username' ),
	array( 'db' => '`u`.`Email`',  'dt' => 1, 'field' => 'Email' ),
	array( 'db' => '`ud`.`Type`',   'dt' => 2, 'field' => 'Type' ),
	array( 'db' => '`u`.`Status`',     'dt' => 3, 'field' => 'Status')
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

$joinQuery = "FROM `users` AS `u` JOIN `user_types` AS `ud` ON (`ud`.`ID_Type` = `u`.`ID_Type`)";
$extraWhere = "";
$groupBy = "`u`.`Username`";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);