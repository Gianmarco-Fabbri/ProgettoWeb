<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Accedi - Benessere market";
$templateParams["nome"] = "accedi_main.php";
$templateParams["js"] = ["js/accedi.js"];
$templateParams["navs"] = [["link" => "accedi.php", "name" => "Accesso"]];

require 'template/base.php';
?>