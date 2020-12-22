<?php

// custom function
function protectPage() {
    session_start();
    if(empty($_SESSION['user'])) {
        header("location:login.php");
    }
}