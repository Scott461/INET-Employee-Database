<?php

$SQL_SELECT_BY_USER_NAME = "SELECT user_name FROM web_users WHERE user_name LIKE :user_name;";
$SQL_CREATE_WEB_USER = "CALL CreateUserProc(:user_name, :hash);";

session_start();

require_once("databaseConnection.php");

function checkIsStrongPassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    return $uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8;
}

$userName = $_POST["userName"];
$password = $_POST["password"];
$reenterPassword = $_POST["reenterPassword"];

$_SESSION['tempUserName'] = $userName;

$pdo = startConnection();


$statement = $pdo->prepare($SQL_SELECT_BY_USER_NAME);
$statement->bindParam(":user_name", $userName, PDO::PARAM_STR);
$statement->execute();

$userNameTaken = $statement->rowCount() !== 0; // boolean variables
$userNameLongEnough = strlen($userName) >= 3;
$passwordsMatch = $password == $reenterPassword;
$strongPassword = checkIsStrongPassword($password);

$message = null;
if (!$userNameLongEnough) {
    $message = "You user name must exceed 3 or more characters";
} elseif ($userNameTaken) {
    $message = "That user name is taken already.";
} elseif (!$passwordsMatch) {
    $message = "Your passwords must match";
} elseif (!$strongPassword) {
    $message = "Your password must contain an upper case and lower case letter, a number, and a special character e.g. Homecity2020%.";
}
if ($message == null) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $statement = $pdo->prepare($SQL_CREATE_WEB_USER);
    $statement->bindParam(":user_name", $userName, PDO::PARAM_STR);
    $statement->bindParam(":hash", $hashedPassword, PDO::PARAM_STR);
    if ($statement->execute()) {
        header("location:index.php");
    } else {
        $errorMessage = $statement->errorInfo()[2];
        echo "<p>Failed to insert a web user. $errorMessage</p>";
    }
} else {
    header("location:register.php?message=$message");
}


closeConnection($pdo);