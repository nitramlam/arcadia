<?php

function getDatabaseConnection()
{
    $DBuser = 'arcadia';
    $DBpass = 'martin37!';
    $pdo = null;

    try {
        $database = 'mysql:host=arcadia33.mysql.database.azure.com;dbname=arcadia;charset=utf8mb4';
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