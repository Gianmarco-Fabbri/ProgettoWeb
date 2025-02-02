<?php
// Invia l'header corretto per il JSON
header('Content-Type: application/json; charset=utf-8');

require_once "../../bootstrap.php";

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$subtotale = 0.0;
$prodotti = [];

foreach ($cart as $idProdotto => $quantita) {
    $prodotto = $dbh->getProdottoByCodice($idProdotto);
    if ($prodotto) {
        $prezzoUnitario = (float) $prodotto['prezzo'];
        $prezzoTotale = $prezzoUnitario * $quantita;
        $subtotale += $prezzoTotale;
        $prodotti[] = [
            "nome" => $prodotto['nome'],
            "immagine" => $prodotto['img'],
            "quantita" => $quantita,
            "prezzoUnitario" => $prezzoUnitario,
            "prezzoTotale" => $prezzoTotale
        ];
    } 
}

// Restituisci il risultato in formato JSON
echo json_encode([
    "success" => true,
    "prodotti" => $prodotti,
    "subtotale" => round($subtotale, 2)
]);
