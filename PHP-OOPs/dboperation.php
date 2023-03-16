<?php
    class dboperation{
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "categories_db";
        public $conn;

        public function __construct() {
            try {
                $conn = mysqli_connect($this->server,$this->user,$this->password,$this->database);
			    $this->conn=$conn;
                //echo "Successfully Connected !";
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function insert($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if($result)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function treeCat($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if(mysqli_num_rows($result) > 0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function select($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if(mysqli_num_rows($result) > 0)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function update($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if($result)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function delete($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if($result)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function mulDelete($query)
        {
            $result = mysqli_query($this->conn, $query) or die ($this->conn->error.__LINE__);
            if($result)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        //Change Status
		public function changeStatus($stid)
	    {
	    	if(isset($_GET["stid"])) 
	    	{
		        if($_GET["status"]=="Active")
		        {
		            $statuschange = mysqli_query($this->conn, "update categories set status='Deactive' where id='".$_GET["stid"]."' ");
		            return $statuschange;
		        }
		        else
		        {
		            $statuschange = mysqli_query($this->conn, "update categories set status='Active' where id='".$_GET["stid"]."' ");
		            return $statuschange;
		        }
		        //echo "<script>window.location='index.php';</script>";
	    	} 
	    }

    }

    $ob = new dboperation();
?>