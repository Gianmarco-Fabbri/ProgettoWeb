<?php
session_start();
define("UPLOAD_DIR", "./img/");

require_once("utils/functions.php");
require_once("db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "ProgettoWeb", "3307"); //ho creato un oggetto della classe helper che è presente in database.php. così lo istanzio una sola volta
?>