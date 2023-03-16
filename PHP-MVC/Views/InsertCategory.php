<?php
require_once('../Controllers/CategoryController.php');
$category = new CategoryController();
$category->insertcategory();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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
  <br>
  <center>
  <?php
      //session_start();
      if (isset($_SESSION['success'])) {
  ?>
        <div class="alert alert-success alert-dismissible fade show form-outline mb-4">
              <h5>Data Inserted Successfuly</h5>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
        <!-- echo '<h1>' . $_SESSION['success'] . '</h1>'; -->
  <?php
        unset($_SESSION['success']);
      }
    ?>
    <br>
    <h3>Add Category Form</h3>
    <a href="Index.php"><button class="btn btn-info"> View All Record</button></a>
</center>
    
<form method="post" action="" enctype="multipart/form-data">
  <div class="container">
  <div class="form-outline mb-4">
    <label class="form-label" for="form4Example1">Parent Category Name</label>
    <select id="parent_id" name="parent_id" class="form-control">
        <option value="">Select Category</option>
            <?php foreach ($category->treeCat() as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name']; ?></option>
            <?php endforeach; ?>
    </select>
  </div>
  <div class="form-outline mb-4">
    <label class="form-label" for="category_name">Category Name</label>
    <input type="text" name="category_name" class="form-control" required />
  </div>
  <div class="form-outline mb-4">
    <label class="form-label" for="description">Category Description</label>
    <textarea class="form-control" name="description" rows="4" required></textarea>
  </div>
  <div class="form-outline mb-4">
    <label class="form-label" for="image">Image</label>
    <!-- <input type="text" name="image" class="form-control" required /> -->
    <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
  <br>
  <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Add</button>
</div>
</form>
</body>
</html>