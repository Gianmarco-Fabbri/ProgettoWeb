<?php
require_once('../bootstrap.php');

header('Content-Type: application/json');

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorizzato']);
    exit;
}

$emailUtente = $_SESSION['email'];

//  Verifico se l'utente è il venditore
$emailVenditore = "venditore@example.com";

if ($emailUtente !== $emailVenditore) {
    http_response_code(403);
    echo json_encode(['error' => 'Accesso negato: Solo il venditore può applicare sconti.']);
    exit;
}

// Ricevo dati dal client
$prodotto = $_POST['prodotto'] ?? null;
$sconto = $_POST['sconto'] ?? null;

if (!$prodotto || !$sconto) {
    http_response_code(400);
    echo json_encode(['error' => 'Dati mancanti']);
    exit;
}

//  Applico lo sconto al prodotto
if ($dbh->applicaSconto($prodotto, $sconto)) {

    // Notifico tutti i clienti
    $clienti = $dbh->getTuttiClienti();

    foreach ($clienti as $cliente) {
        $dbh->aggiungiNotifica($cliente['email'], 'sconto_prodotto', "Il prodotto $prodotto è ora in offerta con uno sconto del $sconto%!");
    }

    echo json_encode(['success' => true, 'message' => 'Sconto applicato e notifiche inviate']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Errore durante l\'applicazione dello sconto']);
}

?>
