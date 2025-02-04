<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profumi - Benessere market";
$templateParams["nome"] = "profumi_main.php";
$templateParams["js"] = ["js/profumi.js"];
$templateParams["navs"] = [["link" => "profumi.php", "name" => "Profumi"]];

require 'template/base.php';
?>