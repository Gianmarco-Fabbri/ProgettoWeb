<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Aggiunta di un nuovo prodotto
    if (
        isset($_POST["nome"]) &&
        isset($_POST["descrizione"]) &&
        isset($_POST["prezzo"]) &&
        isset($_POST["categoria"])
    ) {
        $nome = $_POST["nome"];
        $descrizione = $_POST["descrizione"];
        $prezzo = $_POST["prezzo"];
        $categoria = $_POST["categoria"];
        $dataAggiunta = date("Y-m-d"); // Data automatica
        $numeroRecensioni = 0; // Inizialmente a 0
        $inOfferta = 0; // Inizialmente a 0

        // Generazione codice prodotto univoco
        $codiceProdotto = generaCodiceProdotto($dbh);

        // Gestione immagine (se presente)
        $immaginePath = "img/default.png"; // Immagine di default se non viene caricata
        if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
            $uploadDir = "";
            $immagineNome = basename($_FILES["img"]["name"]);
            $immaginePath = $uploadDir . $immagineNome;
            move_uploaded_file($_FILES["img"]["tmp_name"], $immaginePath);
        }


        // Inserimento nel database
        $result = $dbh->aggiungiProdotto($codiceProdotto, $nome, $descrizione, $prezzo, $dataAggiunta, $numeroRecensioni, $categoria, $inOfferta, $immaginePath);
        echo json_encode(["success" => $result]);
    } else {
        echo json_encode(["error" => "Dati mancanti"]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Recupero prodotti
    $prodotti = $dbh->getProdotti();
    echo json_encode($prodotti);
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    // Eliminazione prodotto
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE["codiceProdotto"])) {
        $codiceProdotto = $_DELETE["codiceProdotto"];
        $result = $dbh->eliminaProdotto($codiceProdotto);
        echo json_encode(["success" => $result]);
    } else {
        echo json_encode(["error" => "Codice prodotto mancante"]);
    }
} else {
    echo json_encode(["error" => "Metodo non supportato"]);
}

/**
 * Genera un codice prodotto casuale e verifica che non sia già presente nel database.
 */
function generaCodiceProdotto($dbh) {
    do {
        $codiceProdotto = "P" . mt_rand(10, 99);
        $esiste = $dbh->verificaCodiceProdotto($codiceProdotto);
    } while ($esiste);

    return $codiceProdotto;
}
?>
