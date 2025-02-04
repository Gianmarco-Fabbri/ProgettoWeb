<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Salute - Benessere market";
$templateParams["nome"] = "salute_main.php";
$templateParams["navs"] = [["link" => "salute.php", "name" => "Salute"]];

require 'template/base.php';
?>