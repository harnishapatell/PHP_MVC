<?php
    class dbclass
    {
        public $host = "localhost";
        public $user = "root";
        public $password = "";
        public $db = "categories_db";
        public $conn;

        public function __construct()
        {
            try {
                $conn = mysqli_connect($this->host,$this->user,$this->password,$this->db);
			    $this->conn=$conn;
                //echo "Successfully Connected !";
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>