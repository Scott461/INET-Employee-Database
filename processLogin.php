<?php

$SQL_SELECT_HASH_BY_USERNAME = "SELECT hash FROM web_users WHERE user_name = :user_name;";

session_start();
require_once("databaseConnection.php");

$userName = $_POST['userName'];
$password = $_POST['password'];

$pdo = startConnection();

$statement = $pdo->prepare($SQL_SELECT_HASH_BY_USERNAME);
$statement->bindParam(":user_name", $userName, PDO::PARAM_STR);
if (!$statement->execute()) {
    die("An error occurred in querying the database: " . $statement->errorCode());
}

$realHash = $statement->fetchColumn(0);
if ($realHash == false) {
    echo "<p>Incorrect user name!</p>";
    echo "<a href='login.php'>Try again</a>";
} else {
    // if match occurs, begins unique user session
    if (password_verify($password, $realHash)) {
        $_SESSION['user'] = $userName;
        header('location:index.php');
    } else {
        // if a match doesn't occur, tells user about the problem
        echo "<p>Incorrect password!</p>";
        echo "<a href='login.php'>Try again</a>";
    }
}

closeConnection($pdo);
