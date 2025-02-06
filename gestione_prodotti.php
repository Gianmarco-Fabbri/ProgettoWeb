<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Gestione Prodotti - Venditore";
$templateParams["nome"] = "template/gestione_prodotti_main.php";
$templateParams["js"] = ["js/gestione_prodotti.js"];

require 'template/base_venditore.php';
?>
