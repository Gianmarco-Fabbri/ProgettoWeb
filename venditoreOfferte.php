<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Gestione offerte - Venditore";
$templateParams["nome"] = "template/venditoreOfferte_main.php";
$templateParams["js"] = ["js/venditoreOfferte.js"];

require 'template/base_venditore.php';
?>
