<?php
error_log("Richiesta ricevuta in calcolaSubtotale.php");

// Includi il database handler (dbh)
require_once "../../bootstrap.php";

// Verifica se il carrello esiste
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotale = 0;

try {
    foreach ($cart as $idProdotto => $quantita) {
        $prezzoKit = $dbh->getKitPrezzo($idProdotto);
        if ($prezzoKit !== null) {
            $subtotale += $prezzoKit * $quantita;
        }
    }

    // Arrotonda il subtotale a 2 cifre decimali
    $subtotale = round($subtotale, 2);

    // Restituisci il subtotale come JSON
    echo json_encode([
        "success" => true,
        "subtotale" => $subtotale
    ]);
} catch (Exception $e) {
    error_log("Errore in calcolaSubtotale.php: " . $e->getMessage());
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}
?>