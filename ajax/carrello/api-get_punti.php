<?php
session_start();
header('Content-Type: application/json');

require_once '../../bootstrap.php';

if (!isset($_SESSION["email"])) {
    echo json_encode(["success" => false, "error" => "Utente non autenticato"]);
    exit;
}

$email = $_SESSION["email"];

$punti = $dbh->getCustomerPoints($email);

if ($punti !== null) {
    echo json_encode(["success" => true, "punti" => $punti]);
} else {
    echo json_encode(["success" => false, "error" => "Impossibile recuperare i punti"]);
}
?>
