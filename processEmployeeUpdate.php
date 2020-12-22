<?php

$SQL_UPDATE_EMPLOYEE = "UPDATE employees SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date,
                        gender = :gender, hire_date = :hire_date WHERE emp_no = :employee_number";
session_start();

require_once("authentication.php");
require_once("databaseConnection.php");

protectPage();

$pdo = startConnection();

$empNo = $_POST['empNo'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$birthDate = $_POST['birthDate'];
$gender = $_POST['gender'];
$hireDate = $_POST['hireDate'];

if (isset($empNo)) {
    $statement = $pdo->prepare($SQL_UPDATE_EMPLOYEE);
    $statement->bindParam(":employee_number", $empNo, PDO::PARAM_INT);
    $statement->bindParam(":first_name", $firstName, PDO::PARAM_STR);
    $statement->bindParam(":last_name", $lastName, PDO::PARAM_STR);
    $statement->bindParam(":birth_date", $birthDate, PDO::PARAM_STR);
    $statement->bindParam(":gender", $gender, PDO::PARAM_STR);
    $statement->bindParam(":hire_date", $hireDate, PDO::PARAM_STR);

    if ($statement->execute()) {
        echo "<p>Successfully updated the employee record</p>";
    } else {
        $errorMessage = $statement->errorInfo()[2];
        echo "<p>Failed to update the employee record. $errorMessage</p>";
    }
}

closeConnection($pdo)

?>
<a href="index.php">Back</a>
<a href="processLogout.php">Logout</a>

