<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Chi siamo | Benessere market";
$templateParams["nome"] = "chi_siamo_main.php";
$templateParams["navs"] = [["link" => "chi_siamo.php", "name" => "Chi siamo"]];

require 'template/base.php';
?>