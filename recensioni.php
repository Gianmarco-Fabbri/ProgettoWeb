<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Recensioni - Benessere market";
$templateParams["nome"] = "recensioni_main.php";
$templateParams["js"] = ["js/recensioni.js"];
$templateParams["navs"] = [["link" => "recensioni.php", "name" => "Recensioni"]];

require 'template/base.php';
?>