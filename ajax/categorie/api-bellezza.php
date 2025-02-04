<?php
header("Content-Type: application/json");
require_once('../../bootstrap.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Legge i dati dalla richiesta POST
$data = json_decode(file_get_contents("php://input"), true);
$minPrice = isset($data['minPrice']) ? floatval($data['minPrice']) : 0;
$maxPrice = isset($data['maxPrice']) ? floatval($data['maxPrice']) : 100;

// Ottieni i prodotti filtrati per prezzo
$filteredProducts = $dbh->getProdottiBellezzaFiltratiPerPrezzo($minPrice, $maxPrice);

// Se non ci sono prodotti, restituisci un array vuoto
if (!$filteredProducts) {
    $filteredProducts = [];
}

// Restituisci i prodotti filtrati come JSON
echo json_encode($filteredProducts);
?>
