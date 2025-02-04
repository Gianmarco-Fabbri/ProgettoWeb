<?php
require_once '../../bootstrap.php';

header("Content-Type: application/json");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
