<?php
// Get ID
$module_id = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($module_id == null || $module_id == false) {
    $error = "Invalid module ID.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'DELETE FROM modules 
              WHERE moduleID = :module_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':module_id', $module_id);
    $statement->execute();
    $statement->closeCursor();

    // Display the module List page
    include('module_list.php');
}
?>
