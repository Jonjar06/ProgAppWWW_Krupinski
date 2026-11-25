<?php
$host = '127.0.0.1';
$port = '3306';
$dbname = 'moja_strona';
$user = 'TWOJ_UZYTKOWNIK';
$pass = 'TWOJE_HASLO';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    throw new Exception("Błąd połączenia z bazą.");
}