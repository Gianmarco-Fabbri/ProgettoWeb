<?php
session_start();
require_once('../bootstrap.php');

header('Content-Type: application/json');

// Controlla se l'utente è autenticato
if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorizzato']);
    exit;
}

$emailUtente = $_SESSION['email'];
$emailVenditore = "venditore@example.com";

// Verifico che SOLO il venditore possa aggiornare lo stato dell'ordine
if ($emailUtente !== $emailVenditore) {
    http_response_code(403);
    echo json_encode(['error' => 'Accesso negato: Solo il venditore può confermare la consegna.']);
    exit;
}

$codiceOrdine = $_POST['codice_ordine'] ?? null;

if (!$codiceOrdine) {
    http_response_code(400);
    echo json_encode(['error' => 'Codice ordine mancante']);
    exit;
}

// Cambio lo stato dell'ordine a "Consegnato"
$dbh->aggiornaStatoOrdine($codiceOrdine);

// Ottengo l'email del cliente
$emailCliente = $dbh->getEmailClienteDaOrdine($codiceOrdine)['emailCliente'];

// Invio notifica al cliente
$dbh->aggiungiNotifica($emailCliente, 'ordine_consegnato', "Il tuo ordine $codiceOrdine è stato consegnato!");

// Invio notifica al venditore
$dbh->aggiungiNotifica($emailVenditore, 'prodotto_consegnato', "Il tuo prodotto nell'ordine $codiceOrdine è stato consegnato!");

echo json_encode(['success' => true, 'message' => 'Notifiche inviate con successo']);

?>
