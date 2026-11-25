<?php
$host = '127.0.0.1';
$port = '3306';
$dbname = 'moja_strona';
$user = 'sklep_user';
$pass = 'haslomaslo123'; 

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    throw new Exception("Błąd połączenia z bazą.");
}