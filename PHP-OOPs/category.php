<?php
	include 'dboperation.php';
	class category{
		public $conn;

        public function __construct()
        {
            $this->conn = new dboperation();
        }

        public function addCategory($data, $file)
        {
        	$parent_id = $data['parent_id'];
        	$category_name = $data['category_name'];
            $description = $data['description'];
            $status = 'Active';

            $permited = array('jpg', 'jpeg', 'png');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "upload/".$unique_image;

            move_uploaded_file($file_temp, $upload_image);

            if(!empty($parent_id))
            {
                $query = "insert into categories(parent_id, category_name,description,image,status) values('$parent_id','$category_name','$description','$upload_image','Active')";

                $result = $this->conn->insert($query);

                if ($result) 
                {
                    $msg = "Data Inserted Successfully !";
                    return $msg;
                } 
                else 
                {
                    $msg = "Data not Inserted !";
                    return $msg;
                }
            }
            else
            {
                $query = "insert into categories( category_name,description,image,status) values('$category_name','$description','$upload_image','Active')";

                $result = $this->conn->insert($query);

                if ($result) 
                {
                    $msg = "Data Inserted Successfully !";
                    return $msg;
                } 
                else 
                {
                    $msg = "Data not Inserted !";
                    return $msg;
                }
            }
            

        }

        public function allCategory()
        {
            $sort_option = "";
            if(isset($_GET['sort_alphabet']))
            {
                if($_GET['sort_alphabet'] == "a-z")
                {
                    $sort_option = "ASC";
                }
                elseif($_GET['sort_alphabet'] == "z-a")
                {
                    $sort_option = "DESC";
                }
            }

                $query = "SELECT * FROM categories ORDER BY category_name $sort_option ";
                $result = $this->conn->select($query);
                return $result;
            
        }


        public function treeCategory($parent_id = "")
        {
            $query = "SELECT * FROM categories ORDER BY id ASC";
            $result = $this->conn->select($query);
            return $result;
        }

        public function getCatById($id)
        {
            $query = "SELECT * FROM categories WHERE id = '$id'";
            $result = $this->conn->select($query);
            return $result;
        }

        public function updateCategory($data, $file, $id)
        {
            $parent_id = $data['parent_id'];
            $category_name = $data['category_name'];
            $description = $data['description'];
            $status = 'Active';

            $permited = array('jpg', 'jpeg', 'png');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = "upload/".$unique_image;

            if(empty($category_name) || empty($description))
            {
                $msg = "Fields Must Not be Empty !";
                return $msg;
            }
            if(!empty($file_name))
            {
                if($file_size > 1048567)
                {
                    $msg = "File Size must be less than 1 MB !";
                    return $msg;
                }
                elseif(in_array($file_ext, $permited) == false)
                {
                    $msg = "You can upload only ".implode(', ', $permited);
                    return $msg;
                }
                else
                {

                    move_uploaded_file($file_temp, $upload_image);

                    $query = "UPDATE categories SET parent_id = '$parent_id', category_name='$category_name', description='$description', image='$upload_image' WHERE id = '$id' ";

                    $result = $this->conn->insert($query);

                    if($result)
                    {
                        $msg = "Data Updated Successfully !";
                        return $msg;
                    }
                    else
                    {
                        $msg = "Data Not Updated !";
                        return $msg;
                    }
                }
            }
            else
            {
                $query = "UPDATE categories SET parent_id = '$parent_id', category_name='$category_name', description='$description' WHERE id = '$id' ";

                    $result = $this->conn->insert($query);

                    if($result)
                    {
                        $msg = "Data Updated Successfully !";
                        return $msg;
                    }
                    else
                    {
                        $msg = "Data Not Updated !";
                        return $msg;
                    }
            }
        }

        public function deleteCategory($id)
        {

                    $query = "DELETE FROM categories WHERE id='".$id."' ";

                    $result = $this->conn->delete($query);

                    if($result)
                    {
                        $msg = "Data Deleted Successfully !";
                        return $msg;
                    }
                    else
                    {
                        $msg = "Data Not Deleted !";
                        return $msg;
                    }
        }

        public function mulDeleteCategory($all)
        {
                    $query = "DELETE FROM categories WHERE id in ($all)";

                    $result = $this->conn->delete($query);

                    if($result)
                    {
                        $errmsg = "Data Deleted Successfully !";
                        return $errmsg;
                    }
                    else
                    {
                        $errmsg = "Data Not Deleted !";
                        return $errmsg;
                    }
        }

        

	}
?>