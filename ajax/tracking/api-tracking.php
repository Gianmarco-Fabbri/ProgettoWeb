<?php
header('Content-Type: application/json');

require_once '../../bootstrap.php';

if (!isset($_GET['ordine']) || empty($_GET['ordine'])) {
    echo json_encode([
        "success" => false,
        "error"   => "ID ordine non fornito."
    ]);
    exit;
}

$orderId = $_GET['ordine'];

$orderData = $dbh->getDataOrdine($orderId);
if (!$orderData) {
    echo json_encode([
        "success" => false,
        "error"   => "Ordine non trovato."
    ]);
    exit;
}

$cliente = $dbh->getClienteData($orderData['emailCliente']);

$products = $dbh->getProductsInOrdine($orderId);

$total = 0;
foreach ($products as $row) {
    $total += floatval($row['prezzo']) * intval($row['quantita']);
}

echo json_encode([
    "success"   => true,
    "order"     => $orderData,
    "customer"  => $cliente,
    "products"  => $products,
    "total"     => number_format($total, 2, '.', '')
]);
?>
