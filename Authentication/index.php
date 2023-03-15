<?php
session_start();
require 'Auth.php';

$select = new Select();


if(isset($_SESSION["id"]))
{
    $user = $select->selectUserById($_SESSION["id"]);
}
else
{
    header("Location: loginpage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <center>
        <h1>Welcome Back : <?php echo $user["firstname"],  $user["lastname"]; ?></h1>

<form action="logout.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>
    </center>
</body>
</html>