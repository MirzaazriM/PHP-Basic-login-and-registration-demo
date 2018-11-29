<?php

session_start();

// import database communicator script
require "../mappers/database_communicator.php";

// get data
$username = strlen($_POST["username"]) > 0 ? $_POST["username"] : null;
$password = strlen($_POST["password"]) > 0 ? $_POST["password"] : null;

// if data is set
if (!is_null($username) && !is_null($password)){
    // call database communicator to check if entered values are correct
    $dc = new DatabaseCommunicator();
    // call method to check credentials
    $status = $dc->check_login($username, $password);

    // make action depending on status value
    if ($status === 200) {
        // set session value/s
        $_SESSION["logged"] = "yes";
        // redirect to main page
        header("Location: main.php");
    } else {
        // if status isnt 200 (user validation failed) set session and redirect to login
        $_SESSION["logged"] = "no";
        header("Location: login_page.php");
    }
} else {
    // if status isnt 200 (user validation failed) set session and redirect to login
    $_SESSION["logged"] = "no";
    header("Location: login_page.php");
}