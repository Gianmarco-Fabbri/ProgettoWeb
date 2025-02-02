<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profilo - Benessere market";
$templateParams["nome"] = "profilo_main.php";
$templateParams["js"] = ["js/logout.js", "js/profilo.js", "js/modificaProfilo.js"];

// Verifica se l'utente è loggato
if (isset($_SESSION['user_email'])) {
    // Recupera i dati dell'utente loggato
    $templateParams["cliente"] = $dbh->getClienteData($_SESSION['user_email']);  
    $templateParams["recensioni"] = $dbh->getCustomerReviews($_SESSION['user_email']);
    $templateParams["messaggi"] = $dbh->getCustomerPoints($_SESSION['user_email']);
} else {
    // Se l'utente non è loggato, reindirizza alla pagina di login
    header('Location: accedi.php');
}
require 'template/base.php';
?>