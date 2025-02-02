<?php
require_once('../bootstrap.php');

header("Content-Type: application/json");

// Verifica la sessione
session_start();
if (!isset($_SESSION["email"])) {
    echo json_encode(["status" => "error", "message" => "Utente non autenticato"]);
    exit();
}

$email = $_SESSION["email"];
$isCliente = !$_SESSION["venditore"];

// Gestione azioni tramite metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $azione = $_POST["azione"] ?? '';

    switch ($azione) {
        case 'getNotifiche':
            $notifiche = $dbh->getNotificheUtente($email);
            echo json_encode(["status" => "success", "notifiche" => $notifiche]);
            break;

        case 'leggiTutto':
            $result = $dbh->updateAllNotify($email, $isCliente);
            echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "" : "Errore nel segnare tutte le notifiche come lette"]);
            break;

        case 'setNotificaLetta':
            $idNotifica = $_POST["id_notifica"] ?? '';
            if ($idNotifica) {
                $result = $dbh->setNotificaLetta($idNotifica);
                echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "" : "Errore nel segnare la notifica"]);
            } else {
                echo json_encode(["status" => "error", "message" => "ID notifica richiesto"]);
            }
            break;

        case 'deleteNotifica':
            $idNotifica = $_POST["id_notifica"] ?? '';
            if ($idNotifica) {
                $result = $dbh->deleteNotify($idNotifica, $isCliente);
                echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "" : "Errore nell'eliminazione della notifica"]);
            } else {
                echo json_encode(["status" => "error", "message" => "ID notifica richiesto"]);
            }
            break;

        case 'countNotificheNonLette':
            $result = $dbh->countNotifyToRead($email, $isCliente);
            echo json_encode(["status" => "success", "count" => $result]);
            break;

        default:
            echo json_encode(["status" => "error", "message" => "Azione non valida"]);
            break;
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metodo non consentito"]);
}
?>
