<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Privacy Policy - Benessere market";
$templateParams["nome"] = "privacy_policy_main.php";
$templateParams["navs"] = [["link" => "privacy_policy.php", "name" => "Privacy Policy"]];

require 'template/base.php';
?>