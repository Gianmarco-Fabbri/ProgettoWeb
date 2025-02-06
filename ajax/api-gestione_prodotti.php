<?php
require_once '../bootstrap.php';

header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["codiceProdotto"])) {
        $codiceProdotto = $_GET["codiceProdotto"];
        $prodotto = $dbh->getProdottoByCodice($codiceProdotto);
        echo json_encode($prodotto);
    } else {
        $prodotti = $dbh->getProdotti();
        echo json_encode($prodotti);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
        // Handle update
        if (isset($_POST["codiceProdotto"], $_POST["nome"], $_POST["descrizione"], $_POST["prezzo"], $_POST["categoria"])) {
            $codiceProdotto = $_POST["codiceProdotto"];
            $nome = $_POST["nome"];
            $descrizione = $_POST["descrizione"];
            $prezzo = floatval($_POST["prezzo"]);
            $categoria = $_POST["categoria"];

            // Gestione immagine
            $immaginePath = null;
            if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
                $uploadDir = "";
                $immagineNome = basename($_FILES["img"]["name"]);
                $immaginePath = $uploadDir . $immagineNome;
                move_uploaded_file($_FILES["img"]["tmp_name"], $immaginePath);
            } else {
                $prodottoEsistente = $dbh->getProdottoByCodice($codiceProdotto);
                $immaginePath = $prodottoEsistente['img'];
            }

            $result = $dbh->aggiornaProdotto(
                $codiceProdotto,
                $nome,
                $descrizione,
                $prezzo,
                $categoria,
                $immaginePath
            );
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Dati mancanti per l'aggiornamento"]);
        }
    } else {
        // Handle create
        if (isset($_POST["nome"], $_POST["descrizione"], $_POST["prezzo"], $_POST["categoria"])) {
            $codiceProdotto = generaCodiceProdotto($dbh);
            $nome = $_POST["nome"];
            $descrizione = $_POST["descrizione"];
            $prezzo = floatval($_POST["prezzo"]);
            $categoria = $_POST["categoria"];
            $dataAggiunta = date("Y-m-d");
            $numeroRecensioni = 0;
            $inOfferta = 0;

            $immaginePath = "img/default.png";
            if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
                $uploadDir = "";
                $immagineNome = basename($_FILES["img"]["name"]);
                $immaginePath = $uploadDir . $immagineNome;
                move_uploaded_file($_FILES["img"]["tmp_name"], $immaginePath);
            }

            $result = $dbh->aggiungiProdotto(
                $codiceProdotto,
                $nome,
                $descrizione,
                $prezzo,
                $dataAggiunta,
                $numeroRecensioni,
                $categoria,
                $inOfferta,
                $immaginePath
            );
            echo json_encode(["success" => $result]);
        } else {
            echo json_encode(["error" => "Dati mancanti"]);
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE") {
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

function generaCodiceProdotto($dbh) {
    do {
        $codiceProdotto = "P" . mt_rand(10, 99);
        $esiste = $dbh->verificaCodiceProdotto($codiceProdotto);
    } while ($esiste);
    return $codiceProdotto;
}
?>