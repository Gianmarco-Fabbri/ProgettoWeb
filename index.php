<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Home | Benessere market";
$templateParams["js"] = array("js/home.js");/*tutti i file .js che devono essere inclusi in questa pagina */
$templateParams["css"] = array("css/home.css");
require 'template/base.php';
?>