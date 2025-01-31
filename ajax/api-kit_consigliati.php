<?php
require_once('bootstrap.php') /*percorso relativo a chi lo chiama (index.php in questo caso)*/

$kits = $dbh->getAllKits();
header("Content-Type: application/json"); /*definisco i tipo di dati da ritornare*/
echo json_encode($kits); /*ritorno un json*/
?>
