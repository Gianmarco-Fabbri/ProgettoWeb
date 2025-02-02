<?php
require_once('../bootstrap.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$azione = $_GET['azione'] ?? '';

switch ($azione) {
    case 'getNotifiche':
        $email = $_GET['email'] ?? '';
        if ($email) {
            $notifiche = $dbh->getNotificheUtente($email);
            header("Content-Type: application/json");
            echo json_encode($notifiche);
        } else {
            echo json_encode(["error" => "Email richiesta"]);
        }
        break;

    case 'setNotificaLetta':
        $idNotifica = $_POST['id'] ?? '';
        if ($idNotifica) {
            $dbh->setNotificaLetta($idNotifica);
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "ID notifica richiesto"]);
        }
        break;

    default:
        echo json_encode(["error" => "Azione non valida"]);
}
?>
