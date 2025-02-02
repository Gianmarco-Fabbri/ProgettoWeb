<?php
require_once('../bootstrap.php'); /* percorso relativo a chi lo chiama */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$prodottiNovita = $dbh->getLatestProducts(4); // Metodo da aggiungere in database.php

header("Content-Type: application/json"); // Specifico il tipo di contenuto
echo json_encode($prodottiNovita); // Trasformo l'array in JSON

?>
