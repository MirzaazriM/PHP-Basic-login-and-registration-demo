<!-- Script handles two things, first it provides registration form for the new users, and secondly
     it validates registration data which user has entered and save it if all requirements are met -->

<?php

    session_start();

    // import database communicator script
    require "../mappers/database_communicator.php";

    // first check if script will handle registration data of the user
    $username = strlen($_POST["username"]) > 0 ? $_POST["username"] : null;
    $email = strlen($_POST["email"]) > 0 ? $_POST["email"] : null;
    $password = strlen($_POST["password"]) ? $_POST["password"] : null;

    // if necessary values are sent check them and redirect to the main page if everything is ok
    if (!is_null($username) && !is_null($email) && !is_null($password)){

        // create database communicator object
        $dc = new DatabaseCommunicator();
        // call its method for saving user
        $status = $dc->registerUser($username, $email, $password);

        // check returned status and make appropriate action
        if ($status === 200){
            // first set in session that user is logged in
            $_SESSION["logged"] = "yes";

            // redirect to main page
            header("Location: main.php");
        } else {
            $errorMessage = "Couldnt register user.";
        }

    }
    // else show HTML for registering users

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Registration Page</title>
        <!-- Include script for handling -->
        <script type="text/javascript" src="../js/registration.js"></script>
    </head>

    <body>
        <h1>User Registration</h1>
        <form action="registration_page.php" method="post">

            <table>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username"/></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email"/></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password"/></td>
                </tr>
            </table>

            <input name="submit" type="submit">

            <p style="color: red">
                <?php
                    global $errorMessage;
                    echo $errorMessage;
                ?>
            </p>

        </form>

    </body>

</html>

<?php

