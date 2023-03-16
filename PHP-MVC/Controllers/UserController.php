<?php 

require_once('../Models/class-user.php');

class UserController extends UserDetails {
    private $user;

        public function __construct() {
            $this->user = new UserDetails();
        }

        public function register() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                $result = $this->user->registeruser($_POST);
                if ($result) {
                    $_SESSION['success'] = '';
                } else {
                    $_SESSION['Error'] = '';
                }
                // Redirect to category list page after update
                header("Location: RegisterUser.php");
                exit;
            }
         }

         public function login() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
        
                if($this->user->loginuser($email, $password)) {
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $this->user->getuserid();
                    $_SESSION['message'] = '';
                    header("Location: Index.php");
                    exit;
                }
                else {
                    $_SESSION['error'] = '';
                }
            }
        }

        public function getusernamebyid($id) {
            $user = $this->user->selectuserbyid($id);
            return $user['firstname'];
        }
        
}