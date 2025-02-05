<?php
require_once '../../bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

// Verifica se il venditore è autenticato
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Venditore non autenticato.']);
    exit();
}

try {
    $ordini = $dbh->getOrdini();
    foreach ($ordini as &$ordine) {
        // Recupera i prodotti associati a ciascun ordine
        $ordine["prodotti"] = $dbh->getProductsInOrdine($ordine["codiceOrdine"]);
    }
    echo json_encode($ordini);
} catch (Exception $e) {
    error_log('Errore nel recupero degli ordini: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.', 'error' => $e->getMessage()]);
}
