<?php
require_once '../../bootstrap.php';

header('Content-Type: application/json');

echo json_encode($dbh->getProdottiInOfferta());
?>
