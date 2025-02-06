<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Brand - Benessere market";
$templateParams["nome"] = "brand_venditore_main.php";
$templateParams["navs"] = [["link" => "brand_venditore.php", "name" => "Brand"]];

require 'template/base_venditore.php';
?>