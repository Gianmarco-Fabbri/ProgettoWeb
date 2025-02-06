<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Cookie Policy - Benessere market";
$templateParams["nome"] = "cookie_policy_venditore_main.php";
$templateParams["navs"] = [["link" => "cookie_policy_venditore.php", "name" => "Cookie Policy"]];

require 'template/base_venditore.php';
?>