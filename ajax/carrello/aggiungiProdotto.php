<?php
session_start();
header('Content-Type: application/json');

error_log(print_r($_POST, true)); // Debug: stampa cosa viene ricevuto

if (isset($_POST['idProdotto']) && isset($_POST['quantita'])) {
    $idProdotto = trim($_POST['idProdotto']); // Trim per eliminare spazi indesiderati
    $quantita = (int)$_POST['quantita'];

    if (empty($idProdotto)) {
        echo json_encode(array('success' => false, 'message' => 'ID prodotto mancante.'));
        exit;
    }

    // Inizializza il carrello se non esiste
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($quantita > 0) {
        if (isset($_SESSION['cart'][$idProdotto])) {
            $_SESSION['cart'][$idProdotto] += $quantita;
        } else {
            $_SESSION['cart'][$idProdotto] = $quantita;
        }
    } else {
        unset($_SESSION['cart'][$idProdotto]);
    }

    error_log(print_r($_SESSION['cart'], true)); // Debug: stampa il carrello dopo l'aggiornamento

    echo json_encode(array('success' => true, 'message' => 'Prodotto aggiunto al carrello.'));
    exit;
} else {
    echo json_encode(array('success' => false, 'message' => 'Parametri mancanti.', 'data' => $_POST));
    exit;
}
?>
