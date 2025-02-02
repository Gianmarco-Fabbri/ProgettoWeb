<?php
require_once('../bootstrap.php');

header("Content-Type: application/json");

// Verifica se la sessione è già attiva prima di avviarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Controllo se l'utente è autenticato
if (!isset($_SESSION["email"])) {
    echo json_encode(["status" => "error", "message" => "Utente non autenticato"]);
    exit();
}

// Definizione delle variabili di sessione in modo sicuro
$email = $_SESSION["email"];
$isCliente = isset($_SESSION["venditore"]) ? !$_SESSION["venditore"] : true; // Se "venditore" non è definito, assumiamo che sia un cliente

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
            if (isset($_POST["id_notifica"])) {
                $idNotifica = $_POST["id_notifica"];
                $result = $dbh->setNotificaLetta($idNotifica);
                echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "" : "Errore nel segnare la notifica"]);
            } else {
                echo json_encode(["status" => "error", "message" => "ID notifica richiesto"]);
            }
            break;

        case 'deleteNotifica':
            if (isset($_POST["id_notifica"])) {
                $idNotifica = $_POST["id_notifica"];
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
