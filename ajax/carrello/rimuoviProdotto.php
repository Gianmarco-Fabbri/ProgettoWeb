<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['idProdotto'])) {
    $idProdotto = $_POST['idProdotto'];

    if (isset($_SESSION['cart'][$idProdotto])) {
        unset($_SESSION['cart'][$idProdotto]);
        echo json_encode(['success' => true, 'message' => 'Prodotto rimosso dal carrello.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Prodotto non trovato nel carrello.']);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'ID prodotto mancante.']);
    exit;
}
?>
