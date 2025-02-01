<?php

require_once '../../bootstrap.php';

header('Content-Type: application/json');

// Ricezione dati JSON
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Nessun dato ricevuto.']);
    exit();
}

// Estrazione dati
$email = isset($data['email']) ? trim($data['email']) : null;
$password = isset($data['password']) ? trim($data['password']) : null;

if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Email o password non possono essere vuoti.']);
    exit();
}

// Controlla se l'utente esiste nel database
$cliente = $dbh->getClienteData($email);
if (!$cliente) {
    echo json_encode(['success' => false, 'message' => 'Utente non trovato.']);
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
