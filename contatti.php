<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Contatti | Benessere market";
$templateParams["nome"] = "contatti_main.php";
$templateParams["navs"] = [["link" => "contatti.php", "name" => "Contatti"]];

require 'template/base.php';
?>