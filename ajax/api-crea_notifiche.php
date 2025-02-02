<?php
require_once('../bootstrap.php');

$azione = $_GET['azione'] ?? '';

switch ($azione) {
    case 'notificaAcquistoCliente':
        $codiceOrdine = $_POST['codiceOrdine'] ?? '';
        if ($codiceOrdine) {
            $cliente = $dbh->getEmailClienteDaOrdine($codiceOrdine);
            if ($cliente) {
                $messaggio = "Hai effettuato un acquisto! Il tuo ordine #$codiceOrdine è in elaborazione.";
                $dbh->aggiungiNotifica($cliente['emailCliente'], 'ordine_effettuato', $messaggio);
            }
            echo json_encode(["success" => true]);
        }
        break;

    case 'notificaSpedizioneOrdine':
        $codiceOrdine = $_POST['codiceOrdine'] ?? '';
        if ($codiceOrdine) {
            $cliente = $dbh->getEmailClienteDaOrdine($codiceOrdine);
            if ($cliente) {
                $messaggio = "Il tuo ordine #$codiceOrdine è stato spedito!";
                $dbh->aggiungiNotifica($cliente['emailCliente'], 'ordine_spedito', $messaggio);
            }
            echo json_encode(["success" => true]);
        }
        break;

    case 'notificaOrdineArrivato':
        $codiceOrdine = $_POST['codiceOrdine'] ?? '';
        if ($codiceOrdine) {
            $cliente = $dbh->getEmailClienteDaOrdine($codiceOrdine);
            if ($cliente) {
                $messaggioCliente = "Il tuo ordine #$codiceOrdine è arrivato a destinazione.";
                $dbh->aggiungiNotifica($cliente['emailCliente'], 'ordine_arrivato', $messaggioCliente);
            }

            $venditori = $dbh->getVenditoriDaOrdine($codiceOrdine);
            foreach ($venditori as $venditore) {
                $messaggioVenditore = "L'ordine #$codiceOrdine è stato consegnato con successo.";
                $dbh->aggiungiNotifica($venditore['email'], 'ordine_arrivato', $messaggioVenditore);
            }

            echo json_encode(["success" => true]);
        }
        break;

    case 'notificaProdottoInOfferta':
        $codiceProdotto = $_POST['codiceProdotto'] ?? '';
        if ($codiceProdotto) {
            $prodotto = $dbh->getNomeProdotto($codiceProdotto);
            if ($prodotto) {
                $messaggio = "Il prodotto \"{$prodotto['nome']}\" è ora in offerta!";
                $clienti = $dbh->getTuttiClienti();
                foreach ($clienti as $cliente) {
                    $dbh->aggiungiNotifica($cliente['email'], 'prodotto_in_offerta', $messaggio);
                }
            }
            echo json_encode(["success" => true]);
        }
        break;

    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>
