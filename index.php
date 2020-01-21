<?php

session_start();

$mainlibrary = $_SERVER["DOCUMENT_ROOT"] . "/lib/main.php";

include_once($mainlibrary);

// $foname = strip_tags(htmlspecialchars($_POST['name']));

// functions
include_once($funcroot . "user.php");
include_once($funcroot . "posts.php");




//site
include_once($temproot . "header.php");

include_once($temproot . "body.php");

include_once($temproot . "footer.php");


?>
