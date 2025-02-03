<?php
require_once "../../bootstrap.php";

$email = $_SESSION['email'] ?? null;
$tipoPagamento = $_POST['tipoPagamento'] ?? null;
$dataArrivo = $_POST['dataArrivo'] ?? null;

if (!$email) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato."]);
    exit;
} 
if (!$tipoPagamento) {
    echo json_encode(["success" => false, "message" => "Dati pagamento non completi."]);
    exit;
} 
if (!$dataArrivo) {
    echo json_encode(["success" => false, "message" => "Data di arrivo non specificata."]);
    exit;
}

$notificaSuccess = $dbh->aggiungiNotifica($email, "Ordine Effettuato", "Hai effettuato un ordine.");

if (!$notificaSuccess) {
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
