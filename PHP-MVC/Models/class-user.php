<?php 

require_once('class-db.php');

    class UserDetails extends DB {
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $phoneno;


        public function registeruser($data) {
            $firstname = $data['firstname'];
        	$lastname = $data['lastname'];
            $email = $data['email'];
            $password = MD5($data['password']);
            $phoneno = $data['phoneno'];

            $duplicate = mysqli_query($this->connection, "SELECT * FROM user WHERE email = '$email' OR phoneno = '$phoneno' ");
            if(mysqli_num_rows($duplicate) > 0)
            {
                return 10;
            }
            else
            {
                //Register Successfully
                $sql = "INSERT INTO user(firstname, lastname, email, password, phoneno) values('$firstname','$lastname','$email','$password','$phoneno')";
                $result = $this->query($sql);

                return 1;
            }

        }

        public function loginuser($email, $password) {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE email=? AND password=MD5(?)");
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

        public function getuserid() {
            return $this->id;
        }

        public function selectuserbyid($id)
        {
            $result = mysqli_query($this->connection, "SELECT * FROM user WHERE id = $id");
            return mysqli_fetch_assoc($result);
        }

    }

?>