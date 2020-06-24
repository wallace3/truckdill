<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
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
$table = <<<EOT
(
   SELECT
     a.id,
     a.name,
     b.position
   FROM table a
   LEFT JOIN positions b ON a.position_id = b.id
) temp
EOT;
 
// Table's primary key
$primaryKey = 'ID_User';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    /*array( 'db' => '`a`.`ID_User`', 'dt' => 0, 'field' =>'ID_User'),
    array( 'db' => '`a`.`Username`', 'dt' => 1, 'field' =>'Username' ),
    array( 'db' => '`a`.`Email`',  'dt' => 2, 'field' =>'Email' ),
    array( 'db' => '`b`.`ID_Type`',   'dt' => 3, 'field' =>'ID_Type' ),
    array( 'db' => '`a`.`Status`',     'dt' => 4, 'field' =>'Status' )*/
  
    //array( 'db' => 'ID_User', 'dt' => 0 ),
    array( 'db' => 'Username', 'dt' => 1 ),
    array( 'db' => 'Email',  'dt' => 2 ),
    array( 'db' => 'ID_Type',   'dt' => 3 ),
    array( 'db' => 'Status',     'dt' => 4 )
);
 
// SQL server connection information
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
 
require( 'ssp.class.php');

/*$joinQuery = "FROM `users` AS `a` JOIN `user_types` AS `b` ON ( `b`.`ID_Type` = `a`.`ID_Type`) ";
$extraWhere = "`a`.ID_Type > 0" ;
$groupBy = "`a`.`ID_User`";
*/

echo json_encode(
//    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy )
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);