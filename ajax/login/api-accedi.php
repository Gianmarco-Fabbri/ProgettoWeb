<?php

require_once '../../bootstrap.php';

header('Content-Type: application/json');

// Ricezione dati JSON
$data = json_decode(file_get_contents('php://input'), true);

$email = isset($data['email']) ? trim($data['email']) : null;
$password = isset($data['password']) ? trim($data['password']) : null;

// Verifica che email e password non siano vuoti
if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Email o password non possono essere vuoti.']);
    exit();
}

// Controlla se l'utente è un cliente
$cliente = $dbh->getClienteData($email);

if ($cliente) {
    // Hash della password inserita
    $hashedPassword = hash('sha256', $password);

    // Confronto tra la password inserita e quella hashata nel database
    if ($hashedPassword !== $cliente['password']) {
        echo json_encode(['success' => false, 'message' => 'Password errata.']);
        exit();
    }

    // Imposta una sessione per il cliente
    session_start();
    $_SESSION['user_email'] = $cliente['email'];
    $_SESSION['user_type'] = 'cliente';

    echo json_encode(['success' => true, 'redirect' => './profile.php', 'message' => 'Login effettuato con successo!']);
    exit();
}

// Se non è un cliente, verifica se è un venditore
$venditore = $dbh->getVenditoreData($email);

if ($venditore) {
    // Hash della password inserita
    $hashedPassword = hash('sha256', $password);

    // Confronto tra la password inserita e quella hashata nel database
    if ($hashedPassword !== $venditore['password']) {
        echo json_encode(['success' => false, 'message' => 'Password errata.']);
        exit();
    }

    // Imposta una sessione per il venditore
    session_start();
    $_SESSION['user_email'] = $venditore['email'];
    $_SESSION['user_type'] = 'venditore';

    echo json_encode(['success' => true, 'redirect' => './venditore.php', 'message' => 'Login effettuato con successo!']);
    exit();
}

// Se non è né cliente né venditore
echo json_encode(['success' => false, 'message' => 'Utente non trovato.']);
exit();

?>
