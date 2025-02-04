<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Tracking | Benessere market";
$templateParams["nome"] = "tracking_main.php";
$templateParams["navs"] = [["link" => "tracking.php", "name" => "Tracking"]];

require 'template/base.php';
?>