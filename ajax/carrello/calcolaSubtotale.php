<?php
error_log("Richiesta ricevuta in calcolaSubtotale.php");

require_once "../../bootstrap.php";

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotale = 0;

try {
    foreach ($cart as $idProdotto => $quantita) {
        $prezzoProdotto = $dbh->getPrezzoProdotto($idProdotto);
        if ($prezzoProdotto !== null) {
            $subtotale += $prezzoProdotto * $quantita;
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