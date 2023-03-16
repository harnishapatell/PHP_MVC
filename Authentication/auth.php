<?php
include 'dbclass.php';

class Auth
{
    public $conn;
        public function __construct() 
        {
            $this->conn = new dbclass();
        }

}

class register extends dbclass{

    public function registration($firstname, $lastname, $email, $password, $phoneno)
    {
        //Email and Phone Number has alredy taken
        $duplicate = mysqli_query($this->conn, "SELECT * FROM user WHERE email = '$email' OR phoneno = '$phoneno' ");
        if(mysqli_num_rows($duplicate) > 0)
        {
            return 10;
        }
        else
        {
            //Register Successfully
            $query = "INSERT INTO user(firstname, lastname, email, password, phoneno) values('$firstname','$lastname','$email','$password','$phoneno')";
            mysqli_query($this->conn, $query);
            return 1;
        }
    }
}
class Login extends dbclass {
    public $id;
    public $email;
    
    public function log($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email=? AND password=MD5(?)");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->id = $row["id"];
            return true; // success
        } else {
            return false; // invalid login
        }
    }
    public function getId() {
        return $this->id;
    }
}

class Select extends dbclass{
    public function selectUserById($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM user WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }
}


?>