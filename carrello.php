<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Carrello - Benessere market";
$templateParams["nome"] = "carrello_main.php";
$templateParams["js"] = ["js/carrello.js"];
$templateParams["navs"] = [["link" => "carrello.php", "name" => "Carrello"]];

require 'template/base.php';
?>