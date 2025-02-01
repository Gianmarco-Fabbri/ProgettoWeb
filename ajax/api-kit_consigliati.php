<?php
    require_once('../bootstrap.php'); /*percorso relativo a chi lo chiama (index.php in questo caso)*/

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $kits = $dbh->getAllKits(4);
    
    header("Content-Type: application/json"); /*specifico il tipo di contenuto*/
    echo json_encode($kits); /*trasformo l'array in json*/
?>