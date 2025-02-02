<?php
session_start();

// Recupera il tipo di spedizione dalla query string
$spedizione = $_GET['spedizione'] ?? null;

// Calcola il costo della spedizione
$costoSpedizione = match ($spedizione) {
    "standard" => 5,
    "express" => 10,
    "premium" => 15,
    default => 0
};

// Calcola il subtotale dal carrello
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotale = 0;
foreach ($cart as $idProdotto => $quantita) {
    $prezzoKit = 10; // Recupera il prezzo reale dal database
    $subtotale += $prezzoKit * $quantita;
}

// Calcola il totale aggiungendo il costo della spedizione
$totale = $subtotale + $costoSpedizione;

echo json_encode([
    "success" => true,
    "totale" => round($totale, 2)
]);
?>