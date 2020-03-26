<?php 
$serverName = "103.108.126.144"; //serverName\instanceName
// $serverName = "10.102.25.214"; //serverName\instanceName
$connectionInfo = array( "Database"=>"eLPrimagama", "UID"=>"sa", "PWD"=>"PrimaGam@4dm!n_()");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Connection established.<br />";
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT * FROM tblinfo";
$stmt = sqlsrv_query( $conn, $sql );
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
echo "<pre>";
print_r($row);
echo "</pre>";

// phpinfo();