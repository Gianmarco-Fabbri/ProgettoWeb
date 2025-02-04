<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Cookie Policy | Benessere market";
$templateParams["nome"] = "cookie_policy_main.php";
$templateParams["navs"] = [["link" => "cookie_policy.php", "name" => "Cookie Policy"]];

require 'template/base.php';
?>