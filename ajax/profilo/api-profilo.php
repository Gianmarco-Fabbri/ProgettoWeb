<?php
require_once '../../bootstrap.php';
header("Content-Type: application/json");


if (!isset($_SESSION["email"])) {
    echo json_encode(["error" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION["email"];

if ($_SESSION["user_type"] == "venditore") {
    $userData = $dbh->getVenditoreData($email);
    echo json_encode($userData);
    exit;
} else {
    $userData = $dbh->getClienteData($email);
    echo json_encode($userData);
    exit;
}
