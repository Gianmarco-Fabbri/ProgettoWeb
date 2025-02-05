<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$productId = $data['productId'];
$discount = $data['discount'];

$success = $dbh->aggiungiOfferta($productId, $discount);

echo json_encode(["success" => $success]);
?>
