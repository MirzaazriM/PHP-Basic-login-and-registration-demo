<?php


// to logout start and then destroy session
session_start();
session_destroy();
// unset setted session "logged" variable
unset($_SESSION["logged"]);

?>


<html>
    <body>
        <h1>Log in</h1>
        <form action="check_login.php" method="post">
            Username: <input type="text" name="username"/><br/>
            Password: <input type="password" name="password"/><br/>
            <input type="submit" name="submit" />
            <br/>
            <a href="registration_page.php">Not registered?</a>
        </form>
    </body>
</html>
