<?php
    require_once("./SessionManager.php");
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
            $stmt = $this->con->prepare("SELECT id, pass, user_type FROM users WHERE name = ?");
            $stmt->bind_param("s", $inputUser);
            $stmt->execute();
            $stmt->bind_result($id, $storedPassword, $user_type);
            $stmt->fetch();
            $stmt->close();

                if ($storedPassword == $inputPassword){
                    $_SESSION["userID"] = $id;
                    $_SESSION["userType"] = $user_type;

                    return true;
                }

            return false;            
        }

        function getUserNamesAndIdsList(){
            $userNamesAndIdsList = array();
            $results = $this->con->query("SELECT id, name FROM users");
    
            while ($row = $results->fetch_assoc()) {
                $userNamesAndIdsList[$row['id']] = $row['name'];
            }
    
            return $userNamesAndIdsList;
        }

        function getUserDataById($userId){
            $stmt = $this->con->prepare("SELECT id, name, pass, user_type FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->bind_result($id, $name, $pass, $user_type);
            $stmt->fetch();
            $userData = [
                'id' => $id,
                'name' => $name,
                'pass' => $pass,
                'user_type' => $user_type
            ];
            $stmt->close();
            return $userData;
        }

        function addUser($username, $password){
            if (!$this->usernameExists($username)){
                $stmt = $this->con->prepare("INSERT INTO users (name, pass, user_type) VALUES (?, ?, 1);");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $stmt->close();
            }
        }

        function usernameExists($username){
            $stmt = $this->con->prepare("SELECT COUNT(*) FROM users WHERE name = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        
            return $count > 0;
        }
    
        function deleteUserById($userId){
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->close();
        }

        function updateUsernameById($userId, $newUsername){
            if (!$this->usernameExists($newUsername)){
                $stmt = $this->con->prepare("UPDATE users SET name = ? WHERE id = ?");
                $stmt->bind_param("si", $newUsername, $userId);
                $stmt->execute();
                $stmt->close();
            }
        }

        function updatePasswordById($userId, $newPassword){
            $stmt = $this->con->prepare("UPDATE users SET pass = ? WHERE id = ?");
            $stmt->bind_param("si", $newPassword, $userId);
            $stmt->execute();
            $stmt->close();
        }

        function updateUserTypeById($userId, $newUserType){
            $stmt = $this->con->prepare("UPDATE users SET user_type = ? WHERE id = ?");
            $stmt->bind_param("ii", $newUserType, $userId);
            $stmt->execute();
            $stmt->close();
        }

        function closeConnection(){
            $this->con->close();
        }
    }
?>