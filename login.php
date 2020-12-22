<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Employee login</h1>
<form action="processLogin.php" method="post">
    <table>
        <tr>
            <td>
                <label for="userName">User:</label>
            </td>
            <td>
                <input name="userName" id="userName" type="text" />
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">Password:</label>
            </td>
            <td>
                <input name="password" id="password" type="password" />
            </td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Login" />
</form>
</body>
</html>