<?php
require_once 'bootstrap.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accedi.php");
    exit();
}

$nomeUtente = $_SESSION['user_id'];
if($dbh->userType($nomeUtente) === "Venditore"){
    header("Location: homePage.php");
    exit;
}

$templateParams["titolo"] = "Carrello | Benessere Market";
$templateParams["nome"] = "carrello_main.php";
$templateParams["prodotti"] = $dbh->getCarrello($nomeUtente);
$templateParams["js"] = array("");

require 'template/base.php';
?>