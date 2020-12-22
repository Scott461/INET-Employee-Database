<?php

$empNo = $_POST["emp_no"];
$firstName = $_POST["first_name"];
$lastName = $_POST["last_name"];
$birthDate = $_POST["birth_date"];
$gender = $_POST["gender"];
$hireDate = $_POST["hire_date"];

?>

<html>
<head>
    <link rel="stylesheet" href="index.css">
    <script src="validation.js"></script>
</head>

<body>
<h3>Update employee record</h3>
<ol id="errorMessages">
</ol>

<form class="customForm" method="post" action="processEmployeeUpdate.php" onsubmit="return validateEmployeeForm();">
    <input type="hidden" name="empNo" value="<?php echo $empNo?>">
    <label for="firstName">First name: </label>
    <input id="firstName" type="text" name="firstName" placeholder="First name" value="<?php echo $firstName?>"/>
    <label for="lastName">Last name: </label>
    <input id="lastName" type="text" name="lastName" placeholder="Last name" value="<?php echo $lastName?>"/>
    <label for="gender">Gender: </label>
    <select id="gender" name="gender">
        <?php if ($gender == 'M'): ?>
            <option value="M" selected>Male</option>
            <option value="F">Female</option>
        <?php else: ?>
            <option value="M" >Male</option>
            <option value="F" selected>Female</option>
        <?php endif; ?>
    </select>
    <label for="birthDate">Birth date: </label>
    <input id="birthDate" type="date" name="birthDate" value="<?php echo $birthDate?>"/>
    <label for="hireDate">Hire date: </label>
    <input id="hireDate" type="date" name="hireDate" value="<?php echo $hireDate?>"/>
    <input type="submit"/>
</form>

<a href="index.php">Back</a>
<a href="processLogout.php">Logout</a>
</body>
</html>