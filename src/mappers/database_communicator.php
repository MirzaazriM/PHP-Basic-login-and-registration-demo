<?php

class DatabaseCommunicator {

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=demo_users;host=localhost', 'root', 'root');
    }


    /**
     * Set registered user data into database
     *
     * @param $username
     * @param $email
     * @param $password
     * @return int
     */
    public function registerUser($username, $email, $password){

        try {

            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // write query
            $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
            // prepare sql
            $statement = $this->connection->prepare($sql);
            // execute query
            $statement->execute([
                $username,
                $email,
                $password
            ]);

            // check if anything is inserted into db and set appropriate status code
            if($statement->rowCount() > 0) {
                $status = 200;
            } else {
                $status = 304;
            }

        // if something goes wrong set status to 304
        }catch (PDOException $e){
            $status = 304;
        }

        // return status
        return $status;
    }


    public function check_login($username, $password){

        try {

            // write query
            $sql = "SELECT username, password FROM users WHERE username = ?";
            // prepare sql
            $statement = $this->connection->prepare($sql);
            // execute query
            $statement->execute([
                $username
            ]);

            // die(print_r($statement->fetch(PDO::FETCH_ASSOC)));

            // check if exists user with given username
            if($statement->rowCount() > 0) {
                // get returned user data
                $data = $statement->fetch(PDO::FETCH_ASSOC);
                // verify that user gave the right password
                if(password_verify($password, $data["password"])){
                    $status = 200;
                }else {
                    $status = 304;
                }

            } else {
                $status = 304;
            }

        }catch (PDOException $e){
            $status = 304;
        }

        // return status
        return $status;
    }
}