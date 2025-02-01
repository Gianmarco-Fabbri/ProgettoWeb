<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['idProdotto']) && isset($_POST['quantita'])) {
    $idProdotto = (int)$_POST['idProdotto'];
    $quantita = (int)$_POST['quantita'];

    // Inizializza il carrello se non esiste
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if ($quantita > 0) {
        $_SESSION['cart'][$idProdotto] = $quantita;
    } else {
        // Rimuovi il prodotto se la quantità è 0 o minore
        unset($_SESSION['cart'][$idProdotto]);
    }

    echo json_encode(array('success' => true, 'message' => 'Quantità aggiornata.'));
    exit;
} else {
    echo json_encode(array('success' => false, 'message' => 'Parametri mancanti.'));
    exit;
}
?>