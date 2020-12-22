<?php // code to END the session when the user logs out

    session_start();
    session_destroy();
    header('location:login.php');