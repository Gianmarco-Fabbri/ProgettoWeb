<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Metodi di pagamento - Benessere market";
$templateParams["nome"] = "pagamento_main.php";
$templateParams["js"] = ["js/pagamento.js"];
$templateParams["navs"] = [["link" => "pagamento.php", "name" => "Metodi di pagamento"]];

require 'template/base.php';
?>