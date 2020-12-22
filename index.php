<?php

$SQL_SELECT_EMPLOYEES = "SELECT * FROM employees WHERE CONCAT(first_name, ' ', last_name) LIKE :search_term 
                         LIMIT :limit_start, :results_per_page;";

session_start();

require_once("authentication.php");
require_once("databaseConnection.php");

protectPage();

$pdo = startConnection();

$userName = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="stylesheet" href="index.css">
    <script src="validation.js"></script>
</head>

<body>
<h1>Search first and last names from database</h1>
<p>Welcome <?php echo $userName ?> to the database!</p>

<form method="get" action="index.php">
    <label for="search">Search: </label>
    <input type="text" id="search" name="search" value="<?php echo $_GET["search"] ?>"/>
    <input type="submit"/>
</form>
<br>
<br>
<table>
    <tr>
        <th>Employee number</th>
        <th>Birth date</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>Hire date</th>
        <th></th>
        <th></th>
    </tr>

    <?php
    $currentPage = 1;
    if (isset($_GET["page"])) {
        $currentPage = $_GET["page"];
    }

    $resultsPerPage = 25;
    $limitStart = ($currentPage - 1) * $resultsPerPage;

    $searchTerm = $_GET["search"];
    $searchTerm = "%$searchTerm%";

    $statement = $pdo->prepare($SQL_SELECT_EMPLOYEES);
    $statement->bindParam(":search_term", $searchTerm, PDO::PARAM_STR);
    $statement->bindParam(":limit_start", $limitStart, PDO::PARAM_INT);
    $statement->bindParam(":results_per_page", $resultsPerPage, PDO::PARAM_INT);
    $statement->execute();
    $rows = $statement->fetchAll();

    foreach ($rows as $row) :
        $empNo = $row["emp_no"];
        $birthDay = $row["birth_date"];
        $firstName = $row["first_name"];
        $lastName = $row["last_name"];
        $gender = $row["gender"];
        $hireDate = $row["hire_date"];
        ?>
        <tr>
            <td><?php echo $empNo ?></td>
            <td><?php echo $birthDay ?></td>
            <td><?php echo $firstName ?></td>
            <td><?php echo $lastName ?></td>
            <td><?php echo $gender ?></td>
            <td><?php echo $hireDate ?></td>
            <td>
                <form method="post" action="employeeUpdate.php">
                    <input type="hidden" name="emp_no" value="<?php echo $empNo?>"/>
                    <input type="hidden" name="first_name" value="<?php echo $firstName?>"/>
                    <input type="hidden" name="last_name" value="<?php echo $lastName?>"/>
                    <input type="hidden" name="birth_date" value="<?php echo $birthDay?>"/>
                    <input type="hidden" name="gender" value="<?php echo $gender?>"/>
                    <input type="hidden" name="hire_date" value="<?php echo $hireDate?>"/>
                    <input type="submit" value="Edit"/>
                </form>
            </td>
            <td><a href= <?php echo "processEmployeeDelete.php?emp_no=$empNo" ?>>Delete</a></td>
        </tr>
    <?php
    endforeach;
    ?>
</table>

<a href="index.php?page=<?php echo max(1, $currentPage - 1) ?>&search=<?php echo $searchTerm ?>">Previous</a>
<p>Page: <?php echo $currentPage ?></p>
<a href="index.php?page=<?php echo $currentPage + 1 ?>&search=<?php echo $searchTerm ?>">Next</a>

<h3>New employee record</h3>
<ol id="errorMessages">

</ol>

<form class="customForm" method="post" action="processEmployeeCreation.php" onsubmit="return validateEmployeeForm();">
    <label for="firstName">First name: </label>
    <input id="firstName" type="text" name="firstName" placeholder="First name"/>
    <label for="lastName">Last name: </label>
    <input id="lastName" type="text" name="lastName" placeholder="Last name"/>
    <label for="gender">Gender: </label>
    <select id="gender" name="gender">
        <option value="M">Male</option>
        <option value="F">Female</option>
    </select>
    <label for="birthDate">Birth date: </label>
    <input id="birthDate" type="date" name="birthDate"/>
    <label for="hireDate">Hire date: </label>
    <input id="hireDate" type="date" name="hireDate"/>
    <input type="submit"/>
</form>
<br>
<a href="processLogout.php">Logout</a>
</body>

</html>
<?php
closeConnection($pdo)
?>