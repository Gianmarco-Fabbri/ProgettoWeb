<?php
require_once "../../bootstrap.php";

$email = $_SESSION['email'] ?? null;
$tipoPagamento = $_POST['tipoPagamento'] ?? null;
$dataArrivo = $_POST['dataArrivo'] ?? null;
$venditoreEmail = "venditore@example.com";

if (!$email) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato."]);
    exit;
} else if (!$tipoPagamento) {
    echo json_encode(["success" => false, "message" => "Dati pagamento non completi."]);
    exit;
} else if (!$dataArrivo) {
    echo json_encode(["success" => false, "message" => "Data di arrivo non specificata."]);
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Il carrello è vuoto."]);
    exit;
}

$totale = 0;
foreach ($cart as $idProdotto => $quantita) {
    $prezzoProdotto = $dbh->getPrezzoProdotto($idProdotto);
    if ($prezzoProdotto !== null) {
        $totale += $prezzoProdotto * $quantita;
    }
}

if ($totale <= 0) {
    echo json_encode(["success" => false, "message" => "Errore: Totale ordine non valido."]);
    exit;
}

if (!$dbh->resetPuntiToCliente($email)) {
    echo json_encode(["success" => false, "message" => "Errore nel reset dei punti."]);
    exit;
}

$result = $dbh->buyOrderByCliente($email, $tipoPagamento, $dataArrivo);

if (!$result['success']) {
    echo json_encode(["success" => false, "message" => "Errore durante l'acquisto: " . $result['message']]);
    exit;
}

if (!$dbh->addPuntiToCliente($email, $totale)) {
    echo json_encode(["success" => false, "message" => "Errore nell'aggiunta dei punti."]);
    exit;
}

$notificaUtente = $dbh->aggiungiNotifica($email, "Ordine Effettuato", "Hai effettuato un ordine.");
$notificaVenditore = $dbh->aggiungiNotifica($venditoreEmail, "Nuovo Ordine", "Hai ricevuto un nuovo ordine.");

if (!$notificaUtente || !$notificaVenditore) {
    echo json_encode(["success" => false, "message" => "Errore durante l'aggiunta della notifica."]);
    exit;
}

unset($_SESSION['cart']);

echo json_encode([
    "success" => true,
    "message" => "Ordine completato con successo! Punti aggiornati.",
    "codiceOrdine" => $result["codiceOrdine"],
    "puntiAggiunti" => $totale
]);
?>
