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
    $recensioni = $dbh->getRecensioniVenditore();
    if ($recensioni) {
        echo json_encode($recensioni);
    } else {
        echo json_encode([]);
    }
} catch (Exception $e) {
    error_log('Errore nel recupero delle recensioni: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.', 'error' => $e->getMessage()]);
}
