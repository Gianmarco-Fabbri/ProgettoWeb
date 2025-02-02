<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profilo - Benessere market";
$templateParams["nome"] = "profilo_main.php";
$templateParams["js"] = ["js/logout.js", "js/profilo.js", "js/modificaProfilo.js"];

// Verifica se l'utente è loggato
if (isset($_SESSION['email'])) {
    $templateParams["cliente"] = $dbh->getClienteData($_SESSION['email']);  
    $templateParams["recensioni"] = $dbh->getCustomerReviews($_SESSION['email']);
    $templateParams["puntiAccumulati"] = $dbh->getCustomerPoints($_SESSION['email']);
} else {
    // Se l'utente non è loggato, reindirizza alla pagina di login
    header('Location: accedi.php');
}
require 'template/base.php';
?>