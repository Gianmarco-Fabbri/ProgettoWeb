<?php

require_once '../../bootstrap.php';

header("Content-Type: application/json; charset=UTF-8");

// Avvia la sessione se non è già attiva
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controlla se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato"]);
    exit;
}


// Recupera i dati 
$data = json_decode(file_get_contents('php://input'), true);
$email = $_SESSION['email'];
$passwordAttuale = $data['passwordAttuale'];
$nuovaPassword = $data['nuovaPassword'];

$utente = $dbh->getClienteData($email) ?: $dbh->getVenditoreData($email);

$result = $_SESSION["user_type"] === "cliente"
    ? $dbh->updatePasswordCliente($email, $passwordAttuale, $nuovaPassword)
    : $dbh->updatePasswordVenditore($email, $passwordAttuale, $nuovaPassword);

// Verifica il risultato e invia una risposta al client
if ($result) {
    echo json_encode(["success" => true, "message" => "Password cambiata con successo! Reindirizzamento in corso..."]);
} else {
    echo json_encode(["success" => false, "message" => "La password attuale non è corretta."]);
}
?>