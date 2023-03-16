<?php

require_once('class-db.php');

    class CategoryDetails extends DB {
        private $id;
        private $parent_id;
        private $category_name;
        private $description;
        private $image;
        private $datetime;
        private $status;
        
        public function addcategory($data, $files) {
            $parent_id = $data['parent_id'];
            $category_name = $data['category_name'];
            $description = $data['description'];
            $image = $files['image']['name'];
            $image_tmp = $files['image']['tmp_name'];
            $image_path = "upload/$image";
            
            move_uploaded_file($image_tmp, $image_path);
            
            if(!empty($parent_id)) {
                $sql = "INSERT INTO categories (parent_id, category_name, description, image, status) 
                        VALUES ('$parent_id','$category_name','$description','$image_path','Active')";
                $result = $this->query($sql);
            } else {
                // insert a dummy record with NULL parent_id
                $sql = "INSERT INTO categories (parent_id, category_name, description, image, status) 
                        VALUES (NULL, '--', 'Dummy Record', '', 'Active')";
                $result = $this->query($sql);
                
                // get the ID of the dummy record
                $dummy_id = mysqli_insert_id($this->connection);
                
                // insert the actual category record with the dummy_id as the parent_id
                $sql = "INSERT INTO categories (parent_id, category_name, description, image, status) 
                        VALUES ('$dummy_id', '$category_name', '$description', '$image_path', 'Active')";
                $result = $this->query($sql);
            }
            
            return $result;
        }
        
        

        public function treecategory() {
            $sql = "SELECT * FROM categories WHERE parent_id IS NOT NULL AND status = 'Active'"; // retrieve data from the database
            $result = $this->query($sql);
            return $result;
        }

        public function getallcategories(){
            $sql = "SELECT * FROM categories WHERE category_name != '--' AND description != 'Dummy Record'
            "; // retrieve data from the database
            $result = $this->query($sql);
        
            if ($result == true) {
                $categories = array();
        
                while($row = $result->fetch_assoc()) {
                    $categories[] = $row;
                }
                return $categories;
            } else {
                die("Couldn't get all categories");
            }
        }

        public function deletecategory($id) {
            $sql = "DELETE FROM categories WHERE id = $id";
            if ($this->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        public function getcategorybyid($id)
        {
            $sql = "SELECT * FROM categories WHERE id = '$id'";
            $result = $this->query($sql);
            return $result;
        }

        public function getcategorynamebyid($id)
        {
            $sql = "SELECT c1.category_name AS category_name, c2.category_name AS parent_name
                    FROM categories c1
                    LEFT JOIN categories c2 ON c1.parent_id = c2.id
                    WHERE c1.id = '$id'";
            $result = $this->query($sql);
            return $result;
        }

        public function updatecategory($data, $id, $files) {
            $parent_id = $data['parent_id'];
            $category_name = $data['category_name'];
            $description = $data['description'];
            $image = '';
            
            if (isset($files['image']) && $files['image']['error'] == 0) {
                $image = $files['image']['name']; // get image name
                $image_tmp = $files['image']['tmp_name']; // get temporary location of image
                move_uploaded_file($image_tmp,"upload/$image");
                $image = "upload/$image";
            } else {
                // Retain the old image
                $result = $this->getcategorybyid($id);
                $category = mysqli_fetch_assoc($result);
                $image = $category['image'];
            }
            
            // Check if the parent ID is null or '--'
            if ($parent_id == null || $parent_id == '--') {
                // Set the parent ID to NULL
                $parent_id = NULL;
            }
            
            $sql = "UPDATE categories SET parent_id = ?, category_name = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("isssi", $parent_id, $category_name, $description, $image, $id);
            $result = $stmt->execute();
            
            return $result;
        }
        
        public function getdatabyid($id)
        {
            $sql = "SELECT * FROM categories WHERE id = '$id'";
            $result = $this->query($sql);
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
        
    }