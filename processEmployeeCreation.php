<?php

$SQL_INSERT_EMPLOYEE = "INSERT INTO employees (first_name, last_name, birth_date, gender, hire_date) 
                        VALUES (:first_name, :last_name, :birth_date, :gender, :hire_date)";

require_once("authentication.php");
require_once("databaseConnection.php");
protectPage();

$pdo = startConnection();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$birthDate = $_POST['birthDate'];
$hireDate = $_POST['hireDate'];

$statement = $pdo->prepare($SQL_INSERT_EMPLOYEE);
$statement->bindParam(":first_name", $firstName, PDO::PARAM_STR);
$statement->bindParam(":last_name", $lastName, PDO::PARAM_STR);
$statement->bindParam(":birth_date", $birthDate, PDO::PARAM_STR);
$statement->bindParam(":gender", $gender, PDO::PARAM_STR);
$statement->bindParam(":hire_date", $hireDate, PDO::PARAM_STR);

if ($statement->execute()) {
    echo "<p>Successfully inserted one employee record</p>";
} else {
    $errorMessage = $statement->errorInfo()[2];
    echo "<p>Failed to insert an employee record. $errorMessage</p>";
}

?>

    <a href="index.php">Back</a>

<?php
closeConnection($pdo);
?>