<?php
require_once('../bootstrap.php');

header('Content-Type: application/json');

if (!isset($_SESSION['email'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorizzato']);
    exit;
}

$email = $_SESSION['email'];
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            $notifiche = $dbh->getNotificheUtente($email);
            echo json_encode($notifiche);
            break;

        case 'PUT':
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['id'])) {
                $success = $dbh->updateNotify($input['id']);
            } else {
                $success = $dbh->updateAllNotify($email);
            }
            echo json_encode(['success' => $success]);
            break;

        case 'DELETE':
            $input = json_decode(file_get_contents('php://input'), true);
            if (!isset($input['id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'ID richiesto']);
                exit;
            }
            $success = $dbh->deleteNotify($input['id']);
            echo json_encode(['success' => $success]);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Metodo non consentito']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>