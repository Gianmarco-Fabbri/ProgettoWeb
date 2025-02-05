<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['idProdotto']) && isset($_POST['quantita'])) {
    $idProdotto = trim($_POST['idProdotto']);
    $quantita = (int)$_POST['quantita'];

    if (empty($idProdotto)) {
        echo json_encode(array('success' => false, 'message' => 'ID prodotto mancante.'));
        exit;
    }

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

    error_log(print_r($_SESSION['cart'], true));
    echo json_encode(['success' => true, 'message' => 'Prodotto aggiunto al carrello.']);
    exit;
} else {
    echo json_encode(array('success' => false, 'message' => 'Parametri mancanti.', 'data' => $_POST));
    exit;
}
?>
