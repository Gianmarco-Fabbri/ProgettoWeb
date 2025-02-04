<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Notifiche - Benessere market";
$templateParams["nome"] = "template/notifiche_main.php";
$templateParams["js"] = ["js/notifiche.js"];
$templateParams["navs"] = [["link" => "notifiche.php", "name" => "Notifiche"]];

require 'template/base.php';
?>