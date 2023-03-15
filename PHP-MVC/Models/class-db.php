<?php 

    class DB {
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $dbname = "categories_db";
        public $connection;


        
        public function __construct() {
            try{
                $this->connection = new mysqli($this->server, $this->user, $this->password, $this->dbname);
                //echo "connection established";
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        // public function query($sql) {
        //     $result = $this->connection->query($sql);
        //     if (!$result) {
        //         die("Query failed: " . $this->connection->error);
        //     }
        //     return $result;
        // }

        public function query($sql) {
            $result = mysqli_query($this->connection, $sql);
            if (!$result) {
                die("Database query error: " . mysqli_error($this->connection));
            }
            return $result;
        }
        
    }


?>