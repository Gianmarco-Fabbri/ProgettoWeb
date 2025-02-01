<?php

require_once '../../bootstrap.php';

header('Content-Type: application/json');

// Ricezione dei dati JSON
$data = json_decode(file_get_contents('php://input'), true);

// Estrazione dei dati
$firstName = $data['first_name'] ?? null;
$lastName = $data['last_name'] ?? null;
$username = $data['username'] ?? null;
$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$password = $data['password'] ?? null;

// Verifica che tutti i campi siano presenti
if (!$firstName || !$lastName || !$username || !$email || !$phone || !$password) {
    echo json_encode(['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
    exit;
}

// Verifica se l'email è già presente nel database
$existingUser = $dbh->getClienteData($email);
if ($existingUser) {
    echo json_encode(['success' => false, 'message' => 'Email già in uso.']);
    exit;
}

// Generazione di un codice carrello univoco
do {
    $cartCode = "C" . rand(1, 9999); // Genera un codice casuale con prefisso C
    $existingCart = $dbh->getCarrelloByCode($cartCode);
} while ($existingCart); // Ripete la generazione finché il codice non è unico

// Hash della password 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Inserimento del nuovo cliente nel database
$insertSuccess = $dbh->createCliente($firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode);

if ($insertSuccess) {
    echo json_encode(['success' => true, 'message' => 'Registrazione completata con successo!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione.']);
}
?>
