<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['idProdotto']) && isset($_POST['quantita'])) {
    $idProdotto = $_POST['idProdotto'];
    $quantita = (int)$_POST['quantita'];

    // Inizializza il carrello se non esiste
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if ($quantita > 0) {
        // Se il prodotto è già presente, incrementa la quantità, altrimenti aggiungilo
        if (isset($_SESSION['cart'][$idProdotto])) {
            $_SESSION['cart'][$idProdotto] += $quantita;
        } else {
            $_SESSION['cart'][$idProdotto] = $quantita;
        }
    } else {
        // Se la quantità è 0 o minore, rimuovi il prodotto
        unset($_SESSION['cart'][$idProdotto]);
    }

    echo json_encode(array('success' => true, 'message' => 'Prodotto aggiunto al carrello.'));
    exit;
} else {
    echo json_encode(array('success' => false, 'message' => 'Parametri mancanti.'));
    exit;
}
?>
