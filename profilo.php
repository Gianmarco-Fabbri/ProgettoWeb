<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profilo - Benessere market";
$templateParams["nome"] = "profilo_main.php";
$templateParams["js"] = ["js/logout.js", "js/profilo.js"];

require 'template/base.php';
?>