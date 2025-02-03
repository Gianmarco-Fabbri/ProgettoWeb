<?php
require_once '../bootstrap.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Avvia la sessione se non è già stata avviata
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

error_log("Dati ricevuti: " . print_r($data, true));

if ($data === null) {
    echo json_encode(['success' => false, 'message' => 'Input JSON non valido.']);
    exit();
}

// Verifica che l'utente sia autenticato
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
    exit();
}

$emailCliente = $_SESSION['email'];
$codProdotto = $data['codProdotto'] ?? null;
$valutazione = $data['valutazione'] ?? null;
$testo = $data['testo'] ?? null;

// Genera codiceRecensione
do {
    $codiceRecensione = "C" . rand(1, 9999);;
    $existingReview = $dbh->getRecensione($codiceRecensione);
} while ($existingReview);

$dataCorrente = date('Y-m-d H:i:s');

if (!$codProdotto || !$valutazione || !is_numeric($valutazione) || $valutazione < 1 || $valutazione > 5) {
    echo json_encode(['success' => false, 'message' => 'Dati non validi.']);
    exit();
}

try {
    $result = $dbh->aggiungiRecensione($codiceRecensione, $testo, $valutazione, $dataCorrente, $emailCliente, $codProdotto);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Recensione aggiunta con successo.']);
    } else {
        error_log('Errore durante l\'aggiunta della recensione.');
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'aggiunta della recensione.']);
    }
} catch (Exception $e) {
    error_log('Errore nell\'aggiunta della recensione: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Errore interno al server.']);
}
