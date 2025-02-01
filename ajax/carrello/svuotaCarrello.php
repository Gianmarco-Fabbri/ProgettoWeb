<?php
session_start();
header('Content-Type: application/json');

// Svuota il carrello: oppure puoi usare unset($_SESSION['cart']);
$_SESSION['cart'] = array();

echo json_encode(array('success' => true, 'message' => 'Carrello svuotato.'));
exit;
?>