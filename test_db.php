<?php
$DBuser = 'arcadia';
$DBpass = getenv('MYSQL_PASSWORD');
$database = 'mysql:host=database:3306;dbname=arcadia;charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    $pdo = new PDO($database, $DBuser, $DBpass, $options);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>