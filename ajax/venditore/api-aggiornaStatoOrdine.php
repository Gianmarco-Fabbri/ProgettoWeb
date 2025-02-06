<?php
require_once '../../bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

// Verifica che il venditore sia autenticato
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Venditore non autenticato.']);
    exit();
}

// Ricezione dati JSON dalla richiesta
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($data['codiceOrdine']) || !isset($data['statoOrdine'])) {
    echo json_encode(['success' => false, 'message' => 'Dati mancanti.']);
    exit();
}

$codiceOrdine = $data['codiceOrdine'];
$statoOrdine = $data['statoOrdine'];

try {
    $ordine = $dbh->getDataOrdine($codiceOrdine);
    if (!$ordine) {
        throw new Exception("Ordine non trovato nel database.");
    }
 
    $emailCliente = $ordine['emailCliente'];    
    $success = $dbh->aggiornaStatoOrdineVenditore($codiceOrdine, $statoOrdine);
    $notificaUtente = $dbh->aggiungiNotifica($emailCliente, "Aggiornamento Ordine", "Il tuo ordine è stato aggiornato.");

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Stato ordine aggiornato con successo.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'aggiornamento dell\'ordine.']);
    }
} catch (Exception $e) {
    error_log("Errore durante l'aggiornamento dello stato dell'ordine: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.']);
}
?>
