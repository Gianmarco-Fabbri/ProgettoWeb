<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profilo Venditore - Benessere Market";
$templateParams["nome"] = "profilo_venditore_main.php";
$templateParams["js"] = ["js/logout.js", 
                         "js/profilo_venditore.js",
                         "js/modificaProfilo.js",
                         "js/eliminaAccount.js",
                         "js/modificaPassword.js"];
$templateParams["navs"] = [["link" => "profilo_venditore.php", "name" => "Profilo Venditore"]];

if (!array_key_exists("user_type", $_SESSION)) {
    $_SESSION["user_type"] = null;
}

if (isset($_SESSION['email']) && $_SESSION["user_type"] == "venditore") {
    $templateParams["venditore"] = $dbh->getVenditoreData($_SESSION['email']);
} else {
    header('Location: accedi.php');
    exit();
}

require 'template/base_venditore.php';
?>
