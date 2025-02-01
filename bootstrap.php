<?php
session_start();
define("UPLOAD_DIR", "./img/");

require_once("utils/functions.php");
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "benessereDB", "3306");

if (!isset($dbh)) {
    echo "Errore: connessione al database non definita.";
    exit;
}
?>