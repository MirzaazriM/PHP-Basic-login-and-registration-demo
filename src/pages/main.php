<?php

// start session
session_start();

// first check session to check if user is allowed to be on this page
if ($_SESSION["logged"] != "yes"){
    // if user is not logged in redirect it to the log in page
    header("Location: login_page.php");
}

// if user is logged show this message
echo "On main page";

?>

<html>

    <body>

        <a href="login_page.php">
            <button>Log out</button>
        </a>

    </body>

</html>