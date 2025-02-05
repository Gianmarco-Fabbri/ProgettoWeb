<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica che il venditore sia autenticato
if (!isset($_SESSION['email']) || $_SESSION['user_type'] !== 'venditore') {
    echo json_encode(['success' => false, 'message' => 'Venditore non autenticato.']);
    exit();
}

$venditoreEmail = $_SESSION['email'];
$venditore = $dbh->getVenditoreData($venditoreEmail);

if ($venditore) {
    echo json_encode(['success' => true, 'venditore' => $venditore]);
} else {
    echo json_encode(['success' => false, 'message' => 'Errore nel recupero del profilo.']);
}
?>
