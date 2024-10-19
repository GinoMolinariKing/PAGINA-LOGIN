<?php


$host = "localhost"; // Host del database
$user = "root";  // Porta del database
$pass = "";
$db = "login"; // Nome del tuo database
$port = 3306;
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(" connessione fallita :( " . $e->getMessage());
}


?>