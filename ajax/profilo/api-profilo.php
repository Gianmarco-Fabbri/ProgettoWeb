<?php
require_once '../../bootstrap.php';
header("Content-Type: application/json");

// Controlla se l'utente è loggato
if (!isset($_SESSION["email"])) {
    echo json_encode(["error" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION["email"];
$userData = $dbh->getClienteData($email);  
if (!$userData) {
    echo json_encode(["error" => "Utente non trovato"]);
    exit;
}

echo json_encode($userData);
exit;
