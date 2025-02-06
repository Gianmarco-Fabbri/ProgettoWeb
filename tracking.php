<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Tracking - Benessere market";
$templateParams["nome"] = "tracking_main.php";
$templateParams["css"] = ["css/tracking.css"];
$templateParams["js"] = ["js/tracking.js"];
$templateParams["navs"] = [["link" => "tracking.php", "name" => "Tracking"]];

require 'template/base.php';
?>