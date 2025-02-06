<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Profilo - Benessere Market";
$templateParams["nome"] = "profilo_main.php";
$templateParams["js"] = ["js/logout.js", 
                         "js/profilo.js", 
                         "js/eliminaAccount.js",
                         "js/modificaPassword.js"];
$templateParams["navs"] = [["link" => "profilo.php", "name" => "Profilo"]];

if (!array_key_exists("user_type", $_SESSION)) {
    $_SESSION["user_type"] = null; 
}

if ($_SESSION["user_type"] === "cliente") {
    $templateParams["js"] = ["js/logout.js", 
                             "js/profilo.js", 
                             "js/eliminaAccount.js",
                             "js/modificaPassword.js",
                             "js/modificaProfilo.js"];
}

if (isset($_SESSION['email'])) {
    if ($_SESSION["user_type"] == "venditore") {
        $templateParams["venditore"] = $dbh->getVenditoreData($_SESSION['email']);
    } else {
        $templateParams["cliente"] = $dbh->getClienteData($_SESSION['email']);
    }
    
    $templateParams["recensioni"] = $dbh->getCustomerReviews($_SESSION['email']);
    $templateParams["puntiAccumulati"] = $dbh->getCustomerPoints($_SESSION['email']);
} else {
    header('Location: accedi.php');
    exit();
}

require $_SESSION["user_type"] == "venditore" ? 'template/base_venditore.php' : 'template/base.php';
?>
