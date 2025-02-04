<?php
session_start();
require_once "../../bootstrap.php";

$email = $_SESSION['email'] ?? null;

if (!$email) {
    echo json_encode(["success" => false, "message" => "Utente non autenticato."]);
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Il carrello è vuoto.", "prodotti" => [], "subtotale" => 0, "totale" => 0]);
    exit;
}

$subtotale = 0;
$prodotti = [];

foreach ($cart as $idProdotto => $quantita) {
    $prodotto = $dbh->getProdottoByCodice($idProdotto);
    if (!$prodotto) {
        continue;
    }

    $prezzo = isset($prodotto['prezzo']) ? $prodotto['prezzo'] : 0;
    $subtotale += $prezzo * $quantita;

    $prodotti[] = [
        "nome" => $prodotto["nome"],
        "quantita" => $quantita,
        "prezzo" => $prezzo,
        "immagine" => $prodotto["img"]
    ];
}

$puntiAccumulati = $dbh->getCustomerPoints($email);
$scontoPunti = $puntiAccumulati / 100;

$totale = max(0, $subtotale - $scontoPunti);

echo json_encode([
    "success" => true,
    "prodotti" => $prodotti,
    "subtotale" => $subtotale,
    "scontoPunti" => $scontoPunti,
    "totale" => $totale
]);
?>
