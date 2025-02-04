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

$notificaUtente = $dbh->aggiungiNotifica($email, "Ordine Effettuato", "Hai effettuato un ordine.");
$notificaVenditore = $dbh->aggiungiNotifica($venditoreEmail, "Nuovo Ordine", "Hai ricevuto un nuovo ordine.");

if (!$notificaUtente || !$notificaVenditore) {
    echo json_encode(["success" => false, "message" => "Errore durante l'aggiunta della notifica."]);
    exit;
}

$result = $dbh->buyOrderByCliente($email, $tipoPagamento, $dataArrivo);

if (!$result['success']) {
    echo json_encode(["success" => false, "message" => "Errore durante l'acquisto: " . $result['message']]);
    exit;
}

echo json_encode([
    "success" => true,
    "message" => "Ordine completato con successo!",
    "codiceOrdine" => $result["codiceOrdine"]
]);
?>
