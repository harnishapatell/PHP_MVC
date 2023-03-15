<?php 
 
// Load the database configuration file 
include_once 'category.php'; 
 
// Fetch records from database 
$cat=new category();
$allcat = $cat->allCategory();

//$query = $con->query("SELECT * FROM categories ORDER BY id ASC"); 
 
if($allcat->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "categories-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('PARENT CATEGORY ID', 'CATEGORY NAME', 'DESCRIPTION', 'IMAGE', 'DATE TIME', 'STATUS'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $allcat->fetch_assoc()){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['parent_id'], $row['category_name'], $row['description'], $row['image'], $row['datetime'], $row['status']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>