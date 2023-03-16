<?php
session_start();
require_once ('../Controllers/CategoryController.php');
require_once ('../Controllers/UserController.php');

$category = new CategoryDetails();
$category = $category->getallcategories();

$categorycontroller = new CategoryController();

// Check if user has requested to delete a category
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $categorycontroller->delete($id);
}

if(isset($_SESSION["id"]))
{
    $userController = new UserController();
}
else
{
    header("Location: LoginUser.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP CRUD Operations using PHP OOP </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>


<body>
    <div class="container" align="center">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h3>PHP CRUD Operations using  PHP OOP</h3> <hr />
                    <div class="row">
                        
                        <div class="row">
                            <div class="col-md-6" align="left">
                                <h4>Welcome <?php echo $userController->getusernamebyid($_SESSION['id']); ?></h4>
                                <a href="InsertCategory.php"><button class="btn btn-primary"> Insert Record</button>
                                </a>
                            </div>
                            <div class="col-md-6" align="right">
                                <form action="Logout.php" method="post">
                                    <button type="submit"  class="btn btn-primary" name="logout">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>         
                    <?php
      //session_start();
      if (isset($_SESSION['success'])) {
  ?>
        <div class="alert alert-success alert-dismissible fade show form-outline mb-4">
              <h5>Data Deleted Successfuly</h5>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
        <!-- echo '<h1>' . $_SESSION['success'] . '</h1>'; -->
  <?php
        unset($_SESSION['success']);
      }
    ?>
            <div class="table-responsive"> 
            <form action="" method="post">               
                <table id="myTable" border="1" class="table table-bordred table-striped">
                    <thead>
                        <th>#</th>
                        <th>Parent Category Name</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Addede Date Time</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                    </thead>
                    <tbody>

                        <?php

                            $cnt = 1;
                                foreach($category as $row)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; $cnt++;?></td>
                                            <td><?php echo $categorycontroller->getCatnameById($row['id'])->fetch_assoc()['parent_name'];?></td>
                                            <td><?php echo htmlentities($row['category_name']);?></td>
                                            <td><?php echo htmlentities($row['description']);?></td>
                                            <td><a href="#" onclick="openPopup('<?php echo $row['image']; ?>')"><img src="<?php echo $row['image']; ?>" width="100"></a></td>
                                            <!-- <td><img src="<?php //echo $row['image']; ?>" width="100"></td> -->
                                            <td><?php echo htmlentities($row['status']);?></td>
                                            <td><?php echo htmlentities($row['datetime']);?></td>
                                            <td><a href="UpdateCategory.php?id=<?php echo htmlentities($row['id']);?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil">Edit</span></a></td>
                                            <td><a href="Index.php?delete=<?php echo htmlentities($row['id']);?>" name="delete" value="submit" class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash">Delete</span></a></td>
                                        </tr>
                                    <?php
                                }
                                ?>  
                    </tbody>
                </table>
 
</div>
            </form>
            </div>
        </div>
    </div>
<script>
    function openPopup(imageUrl) {
        var popup = window.open('', '_blank', 'width=400,height=400');
        popup.document.write('<img src="' + imageUrl + '" style="max-width:100%;max-height:100%;">');
    }
</script>
</body>
</html>