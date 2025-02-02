<?php
session_start();
error_log("Richiesta ricevuta in aggiornaQuantita.php");

try {
    // Recupera i dati dalla richiesta POST
    $idProdotto = $_POST['idProdotto'] ?? null;
    $quantita = intval($_POST['quantita'] ?? 0);

    if (!$idProdotto || $quantita < 0) {
        throw new Exception("Dati mancanti o non validi.");
    }

    // Aggiorna il carrello
    if ($quantita > 0) {
        $_SESSION['cart'][$idProdotto] = $quantita;
        echo json_encode(["success" => true, "message" => "Quantità aggiornata"]);
    } else {
        unset($_SESSION['cart'][$idProdotto]);
        echo json_encode(["success" => true, "message" => "Prodotto rimosso"]);
    }
} catch (Exception $e) {
    error_log("Errore in aggiornaQuantita.php: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>