<?php
    include 'category.php';
    include 'db_connect.php';
    $cat = new category();

    if(isset($_GET['delCat']))
    {
        $id = base64_decode($_GET['delCat']);
        $delCat = $cat->deleteCategory($id);
    }

    error_reporting(E_ALL);
    if (isset($_POST["submit"])) {
        if (count($_POST["ids"]) > 0 ) {
            // Imploding checkbox ids
            $all = implode(",", $_POST["ids"]);
            $mulDelCat = $cat->mulDeleteCategory($all);
            
        } else {
            $errmsg = "You need to select atleast one checkbox to delete!";
        }  
    }

    // Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert alert-danger alert-dismissible';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<?php
    if(isset($_GET['stid']))
    {
        // Geeting deletion row id
        $stid=$_GET['stid'];
        $statuschange=new dboperation();
        $sql=$statuschange->changeStatus($stid);
        if($sql)
        {
            echo "<script>window.location.href='index.php'</script>";
        }
    }
?> 
<?php


if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount = 3;

$sql = "SELECT * FROM categories  WHERE 1";

if ($result = mysqli_query($conn, $sql)) {
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
}

$pagesCount = ceil($rowCount / $perPageCount);

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$sqlQuery = " SELECT * FROM categories WHERE 1 limit " . ($lowerLimit) . " ,  " . ($perPageCount) . " ";
$results = mysqli_query($conn, $sqlQuery);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row" id="results">
            <div class="col-md-12" >
                <h3>PHP CRUD Operations using  PHP OOP</h3> <hr />

                    <!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert alert-dismissible fade show <?php echo $statusType; ?>"><?php echo $statusMsg; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
</div>
<?php } ?>

                    <div class="table-responsive"> 
                    <div class="row">
                        <div class="col-md-4">
                            <form action="" method="GET">
                                    <div class="row">
                                    <div class="col-md-8">
                                        <select name="sort_alphabet" class="form-control" >
                                            <option value="a-z" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "a-z" ){ echo "selected"; } ?> >A-Z (Ascending Order)</option>
                                            <option value="z-a" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet'] == "z-a" ){ echo "selected"; } ?> >Z-A (Descending Order)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="btnsubmit" class="input-group-text btn btn-secondary" id="basic-addon2">Sort</button>
                                    </div>
                                    </div>
                            </form>
                        </div> 
                        <div class="col-md-4">
                            <a href="insert.php"><button class="btn btn-primary"> Insert Record</button>
                            </a>
                            <!-- <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i>Import</a> -->
                            <a href="exportData.php" class="btn btn-success"><i class="dwn"></i>Export Data</a>
                        </div>
                        <div class="col-md-4">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search...">&nbsp;
                        </div id="result">
                        <br/><br/>
                        <div class="col-md-6" id="importFrm" style="display: none;">
                            <form action="importData.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" class="form-control" />
                                <br>
                                <input type="submit" class="btn btn-secondary btn-sm" name="importSubmit" value="IMPORT">
                            </form>
                        </div>

                    </div>
                    
                        <form action="" method="post">               
                    <table id="myTable" class="table data-table">
                    <!-- Message -->
                    <br/>
                    <?php
                    if(isset($delCat))
                    {
                ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><?=$delCat?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                <?php
                    }
                ?>
                    
                    <table class="table table-hover table-responsive" id="myTable">
    <tr>
    <thead>
                            <th>#</th>
                            <th>Parent Category Name</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Date Time</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th colspan="2">
                            <input type="submit" name="submit" value="DeleteAll" class="btn btn-danger btn-md pull-right" onClick="return confirm('Are you sure you want to delete?');" >&nbsp;<br>
                            <input type="checkbox" id="select_all"/>  Select
                            </th>
                        </thead>
    </tr>
    <?php
    $cnt = 1;
     foreach ($results as $data) { ?>
    <tr>
        <td><?php echo $cnt; $cnt++;?></td>
                                        <td><?php echo htmlentities($data['parent_id']);?></td>
                                        <td><?php echo htmlentities($data['category_name']);?></td>
                                        <td><?php echo htmlentities($data['description']);?></td>
                                        <td><img src="<?php echo $data['image']; ?>" height="75" width="100"></td>
                                        <td><?php echo htmlentities($data['datetime']);?></td>
                                        <td><a href="?stid=<?php echo $data["id"];?>&status=<?php echo $data["status"];?>"><?php echo $data["status"];?></td>
                                        <td><a href="update.php?id=<?php echo base64_encode($data['id']);?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil">Edit</span></a></td>
                                        <td><a href="index.php?delCat=<?php echo base64_encode($data['id']);?>" class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash">Delete</span></a></td>
                                        <td align="center"><input type="checkbox" class="checkbox" name="ids[]" value="<?php echo htmlentities($data['id']);?>"/></td>
    </tr>
    <?php
    }
    ?>
</table class="pagination">
                    <div style="height: 30px;"></div>
<table width="50%" align="center">
    <tr>

        <td valign="top" align="left"></td>


        <td valign="top" align="center">
 
	<?php
	for ($i = 1; $i <= $pagesCount; $i ++) {
    if ($i == $pageNumber) {
        ?>
	      <a href="javascript:void(0);" class="current"><?php echo $i ?></a>
<?php
    } else {
        ?>
	      <a href="javascript:void(0);" class="pages"
            onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>');"><?php echo $i ?></a>
<?php
    } // endIf
} // endFor

?>
</td>
        <td align="right" valign="top">
	     Page <?php echo $pageNumber; ?> of <?php echo $pagesCount; ?>
	</td>
    </tr>
</table>
                </form>
                

        </div>
    </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        //search
        $(document).ready(function() {
            $('#search').keyup(function() {
                search_table($(this).val());
            });
            function search_table(value) {
                $('#myTable tr').each(function() {
                    var found = "false";
                    $(this).each(function() {
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
                        {
                            found = "true";
                        }
                    });
                    if(found == 'true')
                    {
                        $(this).show();
                    }
                    else
                    {
                        $(this).hide();
                    }
                });
            }

        });


        //Checkbox select all
        $(document).ready(function(){
            $('#select_all').on('click',function(){
                if(this.checked){
                    $('.checkbox').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('.checkbox').each(function(){
                        this.checked = false;
                    });
                }
            });
            $('.checkbox').on('click',function(){
                if($('.checkbox:checked').length == $('.checkbox').length){
                    $('#select_all').prop('checked',true);
                }else{
                    $('#select_all').prop('checked',false);
                }
            });
        });

//Show/hide CSV upload form -->
function formToggle(ID)
{
    var element = document.getElementById(ID);
    if(element.style.display === "none")
    {
        element.style.display = "block";
    }
    else
    {
        element.style.display = "none";
    }
}
</script>

<link rel="stylesheet" href="dist/bs-pagination.min.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="dist/pagination.min.js"></script>

</body>
</html>


