<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['punti'])) {
    $punti = intval($_POST['punti']);

    // Logica per applicare i punti, ad esempio salvandoli in sessione
    $_SESSION['applied_points'] = $punti;

    echo json_encode(array('success' => true, 'message' => 'Punti applicati.'));
    exit;
} else {
    echo json_encode(array('success' => false, 'message' => 'Nessun valore per i punti.'));
    exit;
}
?>