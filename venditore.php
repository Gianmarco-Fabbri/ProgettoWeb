<?php
require_once 'bootstrap.php';

// Verifica che l'utente sia loggato
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["email"])) {
    header("Location: accedi.php");
    exit();
}

$email = $_SESSION["email"];
$VenditoreYN = $dbh -> isVenditore($email);

var_dump($VenditoreYN);
// Verifica se l'utente è il venditore
if (!$VenditoreYN) {
    header("Location: accedi.php");
    exit();
}

// Se arriva qui, l'utente è il venditore
$templateParams["titolo"] = "Area Venditore";
$templateParams["nome"] = "venditore_main.php";
require 'template/base_venditore.php';
?>
