<?php
require_once '../../bootstrap.php';

header("Content-Type: application/json; charset=UTF-8");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se l'utente è loggato
if (!isset($_SESSION["email"])) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION["email"];
$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$cognome = isset($_POST["cognome"]) ? trim($_POST["cognome"]) : "";
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";

$clienteAttuale = $dbh->getClienteData($email);

// Se i dati non sono cambiati, evita l'aggiornamento
if (trim($clienteAttuale["nome"]) == $nome &&
    trim($clienteAttuale["cognome"]) == $cognome &&
    trim($clienteAttuale["telefono"]) == $telefono) {
    echo json_encode(["success" => true, "message" => "Nessuna modifica rilevata"]);
    exit;
}

$result = $dbh->updateClienteData($email, $nome, $cognome, $telefono);

if ($result === false) {
    echo json_encode(["success" => false, "message" => "Errore durante l'aggiornamento nel database"]);
    exit;
} else {
    echo json_encode(["success" => true, "message" => "Dati aggiornati correttamente"]);
    exit;
}
