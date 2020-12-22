<?php
function startConnection() {
    return new PDO("mysql:host=database;dbname=employees", "scottneilson", "inet2005");
}

function closeConnection(&$pdo) {
    $pdo = null;
}


