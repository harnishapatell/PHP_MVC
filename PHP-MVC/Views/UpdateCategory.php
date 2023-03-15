<?php
require_once('../Controllers/CategoryController.php');
$categoryController = new CategoryController();

$id = $_GET['id'];
$result = $categoryController->getcatbyid($id);
$category = mysqli_fetch_assoc($result); 
$categoryController->update($id);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <center>
    <h3>Add Category Form</h3>
    <a href="Index.php"><button class="btn btn-info"> View All Record</button></a>
  </center>
<form method="post" action="" enctype="multipart/form-data">
  <div class="container">
  <div class="form-outline mb-4">
    <label class="form-label" for="form4Example1">Parent Category Name</label>
    <select id="parent_id" name="parent_id" class="form-control">
    <option value="">Select Category</option>
    <?php foreach ($categoryController->treecat() as $cat): ?>
        <?php $selected = ($cat['id'] == $category['parent_id']) ? 'selected' : ''; ?>
        <option value="<?php echo $cat['id']; ?>" <?php echo $selected; ?>><?php echo $cat['category_name']; ?></option>
    <?php endforeach; ?>
</select>
  </div>
  <br>
  <div class="form-outline mb-4">
    <label class="form-label" for="category_name">Category Name</label>
    <input type="text" value="<?php echo htmlentities($category['category_name']);?>" name="category_name" class="form-control" required />
  </div>
  <br>
  <div class="form-outline mb-4">
    <label class="form-label" for="description">Category Description</label>
    <textarea class="form-control" name="description" rows="4" required><?php echo $category['description'];?></textarea>
  </div>
  <br>
  <div class="form-outline mb-4">
    <label class="form-label" for="image">Image</label>
    <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
    <div>
    <a href="<?php echo $category["image"]; ?>" target="_blank"><img src="<?php echo $category["image"]; ?>" width="150"/></a>
    </div>
  </div>
  <br>
  <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Update</button>
</div>
</form>  
</body>
</html>