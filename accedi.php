<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Accedi - Benessere Market";
$templateParams["nome"] = "accedi_main.php";
$templateParams["js"] = ["js/accedi.js"];
$templateParams["navs"] = [["link" => "accedi.php", "name" => "Accesso"]];

require 'template/base.php';
?>
