<?php
require_once '../../bootstrap.php';
header("Content-Type: application/json");

// Verifica se l'utente è loggato
if (!isset($_SESSION["email"])) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION["email"];
$nome = isset($_POST["nome"]) ? trim($_POST["nome"]) : "";
$cognome = isset($_POST["cognome"]) ? trim($_POST["cognome"]) : "";
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : "";

if (empty($nome) || empty($cognome)) {
    echo json_encode(["success" => false, "message" => "Nome e cognome sono obbligatori"]);
    exit;
}

$result = $dbh->updateClienteData($email, $nome, $cognome, $telefono);

if ($result) {
    echo json_encode(["success" => true, "message" => "Dati aggiornati correttamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Errore durante l'aggiornamento"]);
}
exit;
