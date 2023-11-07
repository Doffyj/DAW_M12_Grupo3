<?php
    session_start();
    class Database{
        private static $host = "localhost";
        private static $user = "root";
        private static $pass = "root";
        private static $dbName = "users";

        private $con;

        function __construct(){
            $this->con = new mysqli(self::$host, self::$user, self::$pass) or die("Error connecting to the database");
            $this->con->select_db(self::$dbName);
        }

        function validateUser($inputUser, $inputPassword){
            $results = $this->con->query("select id, name, pass, user_type from users where name = '$inputUser'");

            while($row = $results->fetch_array()){

                extract($row);

                if ($pass == $inputPassword){
                    $_SESSION["userID"] = $id;
                    $_SESSION["userType"] = $user_type;

                    return true;
                }
            }
        }

        function closeConnection(){
            $this->con->close();
        }
    }
?>
