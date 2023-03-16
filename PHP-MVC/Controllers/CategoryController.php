<?php

require_once('../Models/class-category.php');
//require_once('../views/home.php');

    class CategoryController extends CategoryDetails {
        private $category;

        public function __construct() {
            $this->category = new CategoryDetails();
        }
        public function insertcategory() {
            session_start();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                $result = $this->category->addcategory($_POST, $_FILES);
                if ($result) {
                    $_SESSION['success'] = '';
                } else {
                    $_SESSION['Error'] = '';
                }
                // Redirect to category list page after update
                header("Location: InsertCategory.php");
                exit;
            }
         }

         public function treecat($parent_id = "")
         {
             $categories = $this->category->treecategory();
         
             $result = array();
         
             foreach ($categories as $category) {
                 $result[] = array(
                     'id' => $category['id'],
                     'category_name' => $category['category_name'],
                     'description' => $category['description'],
                     'image' => $category['image']
                 );
             }
             return $result;
         }

        public function index() {
            return $this->category->getAllCategories();
          }

        public function delete($id) {
            //session_start();
            if ($this->category->deletecategory($id)) {
                // echo "Category deleted successfully";
                ?>
                <script>
                    window.location.href = 'Index.php';
                </script>
                <?php
                // header('Location : View/cat/index.php');
                // exit();
            } else {
                echo "Error deleting category";
            }
        }

        public function getcatnamebyid($id) {
            $category = $this->category->getcategorynamebyid($id);
            return $category;
        }

        public function getcatbyid($id) {
            $category = $this->category->getcategorybyid($id);
            return $category;
        }

        function update($id) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                $result = $this->category->updatecategory($_POST, $id, $_FILES);
                if ($result) {
                    $response = array('status' => 'success', 'message' => 'Category updated successfully.');
                } else {
                    $response = array('status' => 'error', 'message' => 'Failed to update category.');
                }
                echo json_encode($response);
                // Redirect to category list page after update
                header("Location: Index.php");
                exit;
            }
        }

        
        
    }
?>