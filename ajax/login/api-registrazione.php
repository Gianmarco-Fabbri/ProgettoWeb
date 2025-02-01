<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

// Legge i dati JSON dal client
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Errore nella lettura dei dati.']);
    exit;
}

$firstName = filter_var($data['first_name'], FILTER_SANITIZE_STRING);
$lastName = filter_var($data['last_name'], FILTER_SANITIZE_STRING);
$username = filter_var($data['username'], FILTER_SANITIZE_STRING);
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = filter_var($data['phone'], FILTER_SANITIZE_STRING);
$password = $data['password'];

if (!$firstName || !$lastName || !$username || !$email || !$phone || !$password) {
    echo json_encode(['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
    exit;
}

// Controlla se l'email è già in uso
$existingCustomer = $dbh->getClienteData($email);
$existingSeller = $dbh->getVenditoreData($email);

if ($existingCustomer || $existingSeller) {
    echo json_encode(['success' => false, 'message' => 'Email già in uso.']);
    exit;
}

// Generazione codice carrello univoco
do {
    $cartCode = "C" . rand(1, 9999);
    $existingCart = $dbh->getCarrelloByCode($cartCode);
} while ($existingCart);

// Hash della password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');


// Inserisce il nuovo utente nel database
try {
    $insertSuccess = $dbh->createCliente($firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode);
    if ($insertSuccess) {
        echo json_encode(['success' => true, 'message' => 'Registrazione completata con successo!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Errore del server.']);
}
?>
