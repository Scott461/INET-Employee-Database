<?php
function startConnection() {
    $host = empty($_ENV['DATABASE_HOST']) ? "database" : $_ENV['DATABASE_HOST'];
    $userName = empty($_ENV['USER_NAME']) ? "scottneilson" : $_ENV['USER_NAME'];
    $password = empty($_ENV['PASSWORD']) ? "inet2005" : $_ENV['PASSWORD'];
    $databaseName = empty($_ENV['DATABASE_NAME']) ? "employees" : $_ENV['DATABASE_NAME'];

    return new PDO("mysql:host=$host;dbname=$databaseName", $userName, $password);
}

function closeConnection(&$pdo) {
    $pdo = null;
}


