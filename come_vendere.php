<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Come Vendere - Benessere market";
$templateParams["nome"] = "come_vendere_main.php";
$templateParams["navs"] = [["link" => "come_vendere.php", "name" => "Come vendere"]];

require 'template/base_venditore.php';
?>