<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Prodotto | Benessere market";
$templateParams["nome"] = "product_main.php";
$templateParams["js"] = ["js/product.js"];
$templateParams["navs"] = [["link" => "product.php", "name" => "Prodotto"]];

require 'template/base.php';
?>