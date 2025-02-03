<?php
require_once '../../bootstrap.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=UTF-8");

// Avvia la sessione se non è già stata avviata
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controlla se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION['email'];
$success = $dbh->eliminaAccountCliente($email);

// Se l'eliminazione è riuscita, distrugge la sessione
if ($success) {
    session_unset();
    session_destroy();
    echo json_encode(["success" => true, "message" => "Account eliminato con successo!"]);
} else {
    echo json_encode(["success" => false, "message" => "Errore durante l'eliminazione dell'account."]);
}

exit;
