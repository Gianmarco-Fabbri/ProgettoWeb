<?php

$spedizione = $_GET['spedizione'] ?? null;

$dataCorrente = new DateTime();
$dataConsegna = match ($spedizione) {
    "standard" => $dataCorrente->modify("+7 days")->format("d F Y"),
    "express" => $dataCorrente->modify("+3 days")->format("d F Y"),
    "premium" => $dataCorrente->modify("+1 day")->format("d F Y"),
    default => "-"
};

echo json_encode([
    "success" => true,
    "dataConsegna" => $dataConsegna
]);
?>