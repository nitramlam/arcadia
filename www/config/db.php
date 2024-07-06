<?php

function getDatabaseConnection()
{
    $DBuser = 'root';
    $DBpass = $_ENV['MYSQL_ROOT_PASSWORD'];
    $pdo = null;

    try {
        $database = 'mysql:host=database:3306;dbname=arcadia';
        $pdo = new PDO($database, $DBuser, $DBpass);
    } catch (PDOException $e) {
        echo "Error: Unable to connect to MySQL. Error:\n $e<br>";
    }

    return $pdo;
}
?>