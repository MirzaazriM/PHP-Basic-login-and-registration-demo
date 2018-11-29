<?php

// when someone comes to the page check if it is logged in or not
if ($_SESSION["user_logged"]){
    // if user is logged redirect it to main page
    header("Location: src/pages/main.php");
} else {
   // if user is not logged redirect it to login or registration page
   header("Location: src/pages/login_page.php");
}
