<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "I miei ordini | Benessere market";
$templateParams["nome"] = "ordini_main.php";
$templateParams["js"] = ["js/ordini.js"];
$templateParams["navs"] = [["link" => "ordini.php", "name" => "I miei ordini"]];

require 'template/base.php';
?>