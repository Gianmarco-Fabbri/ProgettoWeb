<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Area Venditore | Gestione Prodotti";
$templateParams["nome"] = "gestione_prodotti_main.php";
$templateParams["js"] = ["js/gestione_prodotti.js"];

require 'template/base_venditore.php';
?>
