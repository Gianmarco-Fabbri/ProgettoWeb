<?php
require_once '../../bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Venditore non autenticato.']);
    exit();
}

$venditoreEmail = $_SESSION['email'];

try {
    // Aggiungi un log per verificare che l'email venga passata correttamente
    error_log("Email del venditore: " . $venditoreEmail);

    $recensioni = $dbh->getRecensioni();

    // Debug per vedere se il database restituisce risultati
    error_log("Recensioni trovate: " . print_r($recensioni, true));

    if ($recensioni) {
        echo json_encode($recensioni);
    } else {
        echo json_encode([]);
    }
} catch (Exception $e) {
    error_log('Errore nel recupero delle recensioni: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.', 'error' => $e->getMessage()]);
}
