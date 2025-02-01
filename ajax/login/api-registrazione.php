<?php

require_once '../../bootstrap.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$firstName = $data['first_name'] ?? null;
$lastName = $data['last_name'] ?? null;
$username = $data['username'] ?? null;
$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$password = $data['password'] ?? null;

if (!$firstName || !$lastName || !$username || !$email || !$phone || !$password) {
    echo json_encode(['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
    exit;
}

$existingCustomer = $dbh->getClienteData($email);
$existingSeller = $dbh->getVenditoreData($email);

if ($existingCustomer || $existingSeller) {
    echo json_encode(['success' => false, 'message' => 'Email già in uso.']);
    exit;
}

do {
    $cartCode = "C" . rand(1, 9999);
    $existingCart = $dbh->getCarrelloByCode($cartCode);
} while ($existingCart);

// Hash della password in modo sicuro
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insertSuccess = $dbh->createCliente($firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode);

if ($insertSuccess) {
    echo json_encode(['success' => true, 'message' => 'Registrazione completata con successo!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione.']);
}
?>
