<?php
session_start();

$serverName = "DESKTOP-KR1L9M1\RIDA";
$UID = "rida";
$PWD = "123123";
$connectionInfo = array("Database" => "Seerat_un_Nabi_db17(1)", "UID" => $UID, "PWD" => $PWD);


$conn = sqlsrv_connect($serverName, $connectionInfo);

print_r($conn);

if (!$conn) {
    echo "Connection Couldnot Established";
    die(print_r(sqlsrv_errors(), true));
}



