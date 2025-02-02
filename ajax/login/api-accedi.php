<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ricezione dati JSON
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Dati mancanti: specificare email e password.', 'debug' => $data]);
    exit();
}

$email = trim($data['email']);
$password = trim($data['password']);

// Controlla se l'utente esiste nel database
$cliente = $dbh->getClienteData($email);
$venditore = $dbh->getVenditoreData($email);

if (!$cliente && !$venditore) {
    echo json_encode(['success' => false, 'message' => 'Utente non trovato.']);
    exit();
}

// Determina se è un cliente o un venditore
if ($cliente) {
    $utente = $cliente;
    $tipoUtente = 'cliente';
} else {
    $utente = $venditore;
    $tipoUtente = 'venditore';
}

if (empty($utente['password'] || is_null($utente['password']))) {
    echo json_encode([
        'success' => false,
        'message' => 'Errore: password non impostata nel database.',
        'debug'   => print_r($utente, true)
    ]);
    exit;
}

if (hash('sha256', $password) !== $utente['password']) {
    echo json_encode(['success' => false, 'message' => 'Password errata.']);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['user_email'] = $utente['email'];
$_SESSION['user_type']  = $tipoUtente;

echo json_encode(['success' => true, 'redirect' => 'index.php', 'message' => 'Login effettuato con successo!', 'userType' => $tipoUtente]);
exit();
?>