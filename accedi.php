<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Accedi - Benessere Market";
$templateParams["nome"] = "accedi_main.php";
$templateParams["js"] = ["js/accedi.js"];
$templateParams["navs"] = [["link" => "accedi.php", "name" => "Accesso"]];

// Controlla se il form di login è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Verifica se l'email è quella del venditore
    $templateParams["venditore"] = $dbh->getVenditoreData($email);
    $templateParams["cliente"] = $dbh->getClienteData($email);

    if (!empty($templateParams["venditore"])) {
        $_SESSION["email"] = $email;
        $_SESSION["user_id"] = $email;
        $_SESSION["ruolo"] = "venditore";

        $templateFile = 'template/base_venditore.php';  // Carica template venditore
    } elseif (!empty($templateParams["cliente"])) {
        $_SESSION["email"] = $email;
        $_SESSION["user_id"] = $email;
        $_SESSION["ruolo"] = "cliente";

        $templateFile = 'template/base.php';  // Carica template cliente
    } else {
        $templateParams["errore"] = "Email non valida.";
        $templateFile = 'template/base.php'; // Mostra comunque la pagina di accesso
    }
} else {
    $templateFile = 'template/base.php'; // Carica template accesso se non c'è POST
}

require $templateFile;
?>
