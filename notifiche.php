<?php
require_once 'bootstrap.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$templateParams["titolo"] = "Notifiche - Benessere market";
$templateParams["nome"] = "template/notifiche_main.php";
$templateParams["js"] = ["js/notifiche.js"];

require 'template/base.php';
?>