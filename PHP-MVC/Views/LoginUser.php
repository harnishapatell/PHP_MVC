<?php
session_start();
require_once('../Controllers/UserController.php');
$user = new UserController();
$user->login();

if(isset($_SESSION["id"]))
    {
      header("Location : Index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <style type="text/css">
        .error{
            color: red;
            margin-top: 5px;
            padding-left: 10px;
        }
    </style>
<link rel="stylesheet" href="style.css">  </head>
</head>
</head>
<body >
<div class="container">
<?php
      //session_start();
      if (isset($_SESSION['error'])) {
  ?>
        <div class="alert alert-danger alert-dismissible fade show form-outline mb-4">
              <h5>Invalid Login Credentials !!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
        <!-- echo '<h1>' . $_SESSION['success'] . '</h1>'; -->
  <?php
        unset($_SESSION['error']);
      }
    ?>
  <div class="signup-form">
    <form method="post" action="" id="form1">
    <h2>Login Form</h2>
        <div class="form-group">
        	<input type="text" class="form-control" name="email" placeholder="Email">
        </div>
		    <div class="form-group">
            <input type="password" placeholder="Password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <!-- <input type="password" class="form-control" name="password" placeholder="Password"> -->
        </div>
        <div id="message">
            <h5>Password must contain the Following :</h5>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
        <div class="form-group">
        <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Login</button><br/>
        <div class="text-center">Already Registered? <a href="RegisterUser.php">Register</a></div>
        </div>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
<script type="text/javascript">

        jQuery('#form1').validate({
            rules :
            {
                firstname : "required",
                lastname : "required",
                email : 
                {
                    required : true,
                    email : true
                },
                phoneno :
                {
                    required : true,
                    number:true,
                    minlength:10,
                    maxlength:10
                },
                password:
                {
                    required:true
                }
            },
            messages :
            {
                firstname : "Please enter First Name",
                lastname : "Please enter Last Name",
                email : 
                {
                    required:"Please Enter Email",
                    email:"Please Enter Valid Email"
                },
                phoneno :
                {
                    required:"Please Enter Phone No",
                    number:"Only Numbers Valid",
                    minlength:"Minimum 10 Numbers",
                    maxlength:"Maximum 10 Numbers"
                },
                password :
                {
                    required : "Please Enter Password"
                }
            }
        });
</script>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>
</html>
