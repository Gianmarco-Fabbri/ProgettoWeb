<?php
require_once "../../bootstrap.php";

$email = $_SESSION['email'] ?? null;
$tipoPagamento = $_POST['tipoPagamento'] ?? null;
$dataArrivo = $_POST['dataArrivo'] ?? null;

if (!$email || !$tipoPagamento || !$dataArrivo) {
    echo json_encode(["success" => false, "message" => "Dati incompleti."]);
    exit;
}

$result = $dbh->buyOrderByCliente($email, $tipoPagamento, $dataArrivo);

echo json_encode($result);
