<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Bellezza - Benessere market";
$templateParams["nome"] = "bellezza_main.php";
$templateParams["js"] = ["js/bellezza.js"];
$templateParams["navs"] = [["link" => "bellezza.php", "name" => "Bellezza"]];

require 'template/base.php';
?>