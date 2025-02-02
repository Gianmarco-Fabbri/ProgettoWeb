<?php
session_start();

require_once "../../bootstrap.php";

$spedizione = $_GET['spedizione'] ?? null;

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
    $prezzoKit = $dbh->getPrezzoProdotto($idProdotto);
    $subtotale += $prezzoKit * $quantita;
}

// Calcola il totale aggiungendo il costo della spedizione
$totale = $subtotale + $costoSpedizione;

echo json_encode([
    "success" => true,
    "totale" => round($totale, 2)
]);
?>