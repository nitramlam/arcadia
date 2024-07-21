<?php

function getDatabaseConnection()
{
    $DBuser = $_ENV['DB_USERNAME'];
    $DBpass = $_ENV['DB_PASSWORD'];
    $DBhost = $_ENV['DB_HOST'];
    $DBname = $_ENV['DB_DATABASE'];
    $pdo = null;

    try {
        $database = "mysql:host=$DBhost;dbname=$DBname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ];
        $pdo = new PDO($database, $DBuser, $DBpass, $options);
    } catch (PDOException $e) {
        echo "Error: Unable to connect to MySQL. Error:\n $e<br>";
    }

    return $pdo;
}
?>