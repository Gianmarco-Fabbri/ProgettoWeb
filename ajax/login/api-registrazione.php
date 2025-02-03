<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Legge i dati JSON dal client
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Errore nella lettura dei dati.']);
    exit;
}

// Sanificazione input
$firstName = htmlspecialchars(strip_tags($data['first_name']));
$lastName = htmlspecialchars(strip_tags($data['last_name']));
$username = htmlspecialchars(strip_tags($data['username']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(strip_tags($data['phone']));
$password = trim($data['password']);

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

// Hash della password con SHA2
$hashedPassword = hash('sha256', $password);

try {
    $insertSuccess = $dbh->createCliente($firstName, $lastName, $username, $email, $hashedPassword, $phone, $cartCode);
    if ($insertSuccess) {
        $_SESSION['email'] = $email; // login automatico
        echo json_encode(['success' => true, 'message' => 'Registrazione completata con successo!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Errore del server.', 'debug' => $e->getMessage()]);
}
?>
