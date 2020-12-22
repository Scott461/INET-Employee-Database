<?php session_start(); ?>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<form action="processRegister.php" method="post">
    <div class="container">
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
                <h6 class="card-subtitle mb-2 text-muted">Create Administrator account</h6>
                <div class="alert alert-danger" role="alert"><?php echo $_GET['message'] ?></div>
                <div class="form-group">
                    <label for="userName">User name</label>
                    <input type="text" name="userName" class="form-control" id="userName"
                           value="<?php echo $_SESSION['tempUserName'] ?>" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label for="password">Enter password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="reenterPassword">Re-enter password</label>
                    <input type="password" name="reenterPassword" class="form-control" id="reenterPassword"
                           placeholder="Re-enter password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>