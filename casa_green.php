<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Casa & Green - Benessere market";
$templateParams["nome"] = "casa_green_main.php";
$templateParams["js"] = ["js/casa&green.js"];
$templateParams["navs"] = [["link" => "casa_green.php", "name" => "Casa & Green"]];

require 'template/base.php';
?>