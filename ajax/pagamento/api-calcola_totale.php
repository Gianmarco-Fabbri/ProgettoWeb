<?php
session_start();
require_once "../../bootstrap.php";

$email = $_SESSION['email'] ?? null;
$tipoSpedizione = $_GET['spedizione'] ?? null;

if (!$email || !$tipoSpedizione) {
    echo json_encode(["success" => false, "message" => "Parametri mancanti."]);
    exit;
}

// Calcola il subtotale
$cart = $_SESSION['cart'] ?? [];
$subtotale = 0;

foreach ($cart as $idProdotto => $quantita) {
    $prezzoProdotto = $dbh->getPrezzoProdotto($idProdotto);
    if ($prezzoProdotto !== null) {
        $subtotale += $prezzoProdotto * $quantita;
    }
}

// Calcola il costo della spedizione
$costoSpedizione = 0;
switch ($tipoSpedizione) {
    case 'standard':
        $costoSpedizione = 5.00;
        break;
    case 'express':
        $costoSpedizione = 10.00;
        break;
    case 'premium':
        $costoSpedizione = 15.00;
        break;
    default:
        echo json_encode(["success" => false, "message" => "Tipo di spedizione non valido."]);
        exit;
}

// Recupera i punti dell'utente
$puntiAccumulati = $dbh->getCustomerPoints($email);
$scontoPunti = $puntiAccumulati / 100; // 100 punti = 1€ di sconto

// Calcola il totale considerando il costo della spedizione e lo sconto punti
$totale = max(0, $subtotale + $costoSpedizione - $scontoPunti);

echo json_encode([
    "success" => true,
    "subtotale" => $subtotale,
    "costoSpedizione" => $costoSpedizione,
    "scontoPunti" => $scontoPunti,
    "totale" => $totale
]);
?>
