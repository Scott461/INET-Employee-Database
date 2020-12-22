<?php

$SQL_DELETE_EMPLOYEE = "DELETE FROM employees WHERE emp_no = :employee_number;";

session_start();

require_once("authentication.php");
require_once("databaseConnection.php");

protectPage();

$pdo = startConnection();

$empNo = $_GET["emp_no"];
if (isset($_GET["confirmed"])):

    $statement = $pdo->prepare($SQL_DELETE_EMPLOYEE);
    $statement->bindParam(":employee_number", $empNo, PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "<p>Successfully deleted one employee record</p>";
    } else {
        $errorMessage = $statement->errorInfo()[2];
        echo "<p>Failed to delete an employee record. $errorMessage</p>";
    }
    ?>
    <a href="index.php">Back</a>
<?php
else:

    echo "<p>Are you sure you want to delete employee number: $empNo</p>";
    ?>

    <a href=<?php echo "processEmployeeDelete.php?emp_no=$empNo&confirmed" ?>>Yes</a>
    <a href="index.php">Cancel</a>
<?php
endif;
?>
<a href="processLogout.php">Logout</a>
<?php
closeConnection($pdo)
?>

