<?php
session_start();

// Verifica se il carrello esiste
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$subtotale = 0;
$prodotti = [];

// Simula il recupero dei dati dal database
require_once "../../bootstrap.php"; // Assicurati che la connessione al database sia inclusa

foreach ($cart as $idProdotto => $quantita) {
    // Recupera i dettagli del prodotto dal database
    $stmt = $dbh->prepare("SELECT nome, prezzo FROM prodotti WHERE id = ?");
    $stmt->bind_param("i", $idProdotto);
    $stmt->execute();
    $result = $stmt->get_result();
    $prodotto = $result->fetch_assoc();

    if ($prodotto) {
        $nomeProdotto = $prodotto['nome'];
        $prezzoUnitario = $prodotto['prezzo'];
        $prezzoTotale = $prezzoUnitario * $quantita;

        // Aggiungi il prodotto alla lista
        $prodotti[] = [
            "nome" => $nomeProdotto,
            "prezzoUnitario" => $prezzoUnitario,
            "quantita" => $quantita,
            "prezzoTotale" => $prezzoTotale
        ];

        // Aggiorna il subtotale
        $subtotale += $prezzoTotale;
    }
}

echo json_encode([
    "success" => true,
    "prodotti" => $prodotti,
    "subtotale" => round($subtotale, 2)
]);
?>