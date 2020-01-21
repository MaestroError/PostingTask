<?php
$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/mainlib.php";

include_once($mainlibrary);

// connection func
function db_connect($dbname) {
    $servername = $GLOBALS["db_server"];
    $username = $GLOBALS["db_user"];
    $password = $GLOBALS["db_pass"];

    $connect = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connect;
}

?>
