<?php

session_start();

$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/main.php";

include_once($mainlibrary);

// functions
include_once($funcroot . "user.php");


//site
include_once($temproot . "header.php");

    include_once("body.php");

include_once($temproot . "footer.php");


?>
