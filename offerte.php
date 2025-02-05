<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Area Venditore | Gestione offerte";
$templateParams["nome"] = "template/offerte_main.php";
$templateParams["js"] = ["js/offerte.js"];

require 'template/base_venditore.php';
?>
