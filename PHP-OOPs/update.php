<?php 
    include 'category.php';
    $cat = new category();

    if(isset($_GET['id']))
    {
        $id = base64_decode($_GET['id']);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $insert = $cat->updateCategory($_POST, $_FILES, $id);
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

        <?php
            $getCat = $cat->getCatById($id);
            if($getCat)
            {
                while($row = mysqli_fetch_assoc($getCat))
                {
        ?>
                    <form name="insertrecord" id="insertrecord" method="post" enctype="multipart/form-data">
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
                                                while($row1 = mysqli_fetch_assoc($treeCat))
                                            {
                                        ?>
                                                <option <?php if($row1["id"]==$row1["id"]) { ?> selected <?php } ?> value="<?php echo $row1['id'];?>"><?php echo $row1["category_name"];?></option>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"><b>Category Name :</b>
                                <input type="text" value="<?php echo htmlentities($row['category_name']);?>" name="category_name" class="form-control">
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="col-md-12"><b>Description :</b>
                                <textarea class="form-control" name="description"><?php echo htmlentities($row['description']);?></textarea>
                            </div>
                        </div><br/>  
                        <div class="row">
                            <div class="col-md-12"><b>Image :</b>
                                <!-- <input type="text" name="image" class="form-control" required> -->
                                <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
                            </div>&nbsp;
                            <a href="img/<?php echo $row["image"]; ?>" target="_blank"><img src="<?php echo $row["image"]; ?>" width="150"/></a>
                        </div>  
                        <div class="row" style="margin-top:1%">
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-success" name="btnupdate" value="Update Category">
                            </div>
                        </div> 
                    </form>     
                <?php
                }
            }
        ?>      
    </div>
</body>
</html>

