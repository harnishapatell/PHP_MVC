<?php 
    include 'category.php';
    $cat = new category();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $insert = $cat->addCategory($_POST, $_FILES);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!------ Include the above in your HEAD tag ---------->

    <title>Insert</title>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-12" align="center"><br><br>
                <h3>Insert Record | PHP CRUD Operations using  PHP OOP</h3><hr />
                <br/>
                <?php
                    if(isset($insert))
                    {
                ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><?=$insert?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                <?php
                    }
                ?>
            </div>
            <a href="index.php"><button class="btn btn-info"> View All Record</button></a>
        </div><br/><br/>
        <form id="form1" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6"><b>Parent Category Name :</b>
                    <div>
                        <select id="parent_id" name="parent_id" class="form-control">
                        <option value="">Select Category</option>
                            <?php
                                $treeCat = $cat->treeCategory();
                                $cnt = 1;
                                if($treeCat)
                                {
                                    while($row = mysqli_fetch_assoc($treeCat))
                                {
                            ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row["category_name"];?></option>
                            <?php
                                }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6"><b>Category Name :</b>
                    <input type="text" name="category_name" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-md-12"><b>Description :</b>
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div><br/>  
            <div class="row">
                <div class="col-md-12"><b>Image :</b>
                    <!-- <input type="text" name="image" class="form-control" required> -->
                    <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
                </div>
            </div>  
            <div class="row" style="margin-top:1%">
                <div class="col-md-8">
                    <input type="submit" class="btn btn-success" name="btninsert" value="Submit">
                </div>
            </div> 
        </form>           
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
    <script type="text/javascript">
        jQuery('#form1').validate({
            rules :
            {
                category_name : "required",
                description : "required"
            },
            messages :
            {
                category_name : "Please enter Category Name",
                description : "Please enter Some Description"
            }
        });
    </script>
</body>
</html>

