<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Registrazione - Benessere market";
$templateParams["nome"] = "registrazione_main.php";
$templateParams["js"] = ["js/registrazione.js"];
$templateParams["navs"] = [["link" => "registrazione.php", "name" => "Registrazione"]];

require 'template/base.php';
?>