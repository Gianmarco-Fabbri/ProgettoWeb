<?php
require_once('../bootstrap.php');

header('Content-Type: application/json');

// Verifica se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorizzato']);
    exit;
}

// Definizione delle variabili
$emailCliente = $_SESSION['email'];
$codiceOrdine = $_POST['codice_ordine'] ?? null;
$emailVenditore = "venditore@example.com"; 

// Controlla se il codice ordine è presente
if (!$codiceOrdine) {
    http_response_code(400);
    echo json_encode(['error' => 'Codice ordine mancante']);
    exit;
}

// Inserisco la notifica per il venditore
$messaggioVenditore = "Un cliente ($emailCliente) ha acquistato un tuo prodotto. Codice ordine: $codiceOrdine.";

$success = $dbh->aggiungiNotifica($emailVenditore, 'ordine_cliente', $messaggioVenditore);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Notifica inviata al venditore']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Errore nell\'invio della notifica']);
}
?>
