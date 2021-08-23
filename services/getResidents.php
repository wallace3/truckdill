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
$table = 'residents';

// Table's primary key
$primaryKey = 'ID_Resident';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`x`.`ID_Resident`', 'dt' => 0, 'field' => 'ID_Resident' ),
    array( 'db' => '`x`.`Name`', 'dt' => 1, 'field' => 'Name' ),
    array( 'db' => '`x`.`Phone`',  'dt' => 2, 'field' => 'Phone'),
    array( 'db' => '`x`.`Email`',  'dt' => 3, 'field' => 'Email'),
    array( 'db' => '`x`.`Username`',  'dt' => 4, 'field' => 'Username'),
    array( 'db' => '`x`.`Drill`',  'dt' => 5, 'field' => 'Drill'),
    array( 'db' => '`x`.`Status`', 'dt' => 6, 'field' => 'Status' ),
    array( 'db' => '`x`.`ID_User`', 'dt' => 7, 'field' => 'ID_User' ),
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
                SELECT re.ID_Resident, re.Name, us.Status, re.Phone, us.Username, us.Email, drills.Name Drill, us.ID_User
                FROM residents re 
                JOIN users us ON us.ID_User = re.ID_User 
                JOIN drills ON drills.ID_Drill = re.ID_Drill
                WHERE us.Status != 3
                ) x";
$extraWhere = "";
$groupBy = "";
$having = "";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
);