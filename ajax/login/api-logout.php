<?php

require_once '../../bootstrap.php';

session_start();
header("Content-Type: application/json");

// Controlla se la richiesta è di tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_unset();
    session_destroy();
    echo json_encode(["message" => "Logout effettuato con successo"]);
    exit;
} else {
    http_response_code(405);
    echo json_encode(["error" => "Metodo non consentito"]);
    exit;
}
?>
