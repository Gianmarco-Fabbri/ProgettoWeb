<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Contatti - Benessere market";
$templateParams["nome"] = "contatti_venditore_main.php";
$templateParams["navs"] = [["link" => "contatti_venditore.php", "name" => "Contatti"]];

require 'template/base_venditore.php';
?>