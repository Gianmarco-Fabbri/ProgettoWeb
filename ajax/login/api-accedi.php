<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ricezione dati JSON
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['email'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Dati mancanti.', 'debug' => $data]);
    exit();
}

$email = trim($data['email']);
$password = trim($data['password']);

// Controlla se l'utente esiste nel database
$cliente = $dbh->getClienteData($email);
if (!$cliente) {
    echo json_encode(['success' => false, 'message' => 'Utente non trovato.']);
    exit();
}

if (empty($cliente['password']) || is_null($cliente['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Errore: password non impostata nel database.',
        'debug' => print_r($cliente, true)
    ]);
    exit();
}

// Verifica la password
if (!password_verify($password, $cliente['password'])) {
    echo json_encode(['success' => false, 'message' => 'Password errata.']);
    exit();
}

// Avvia la sessione
session_start();
$_SESSION['user_email'] = $cliente['email'];

echo json_encode(['success' => true, 'redirect' => 'profile.php', 'message' => 'Login effettuato con successo!']);
exit();
