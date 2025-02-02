<?php

require_once '../../bootstrap.php';
session_start();

header("Content-Type: application/json");

// Controlla se l'utente è loggato
if (!isset($_SESSION["email"])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Utente non autenticato"]);
    exit;
}

// Altrimenti recuperi i dati dal DB (o dalla sessione stessa)
$userId = $_SESSION["email"];

// Esempio: query al DB (ovviamente sostituisci con la tua logica/variabili)
$userData = $dbh->getClienteData($email); 

if (!$userData) {
    http_response_code(404);
    echo json_encode(["error" => "Utente non trovato"]);
    exit;
}

// Se tutto ok, rimanda i dati in JSON
echo json_encode([
    "nome" => $userData["nome"],
    "cognome" => $userData["cognome"],
    "email" => $userData["email"],
    "telefono" => $userData["telefono"]
]);
exit;
