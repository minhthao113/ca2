<?php
require_once('database.php');

// Get IDs
$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$module_id = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($assignment_id != false && $module_id != false) {
    $query = "DELETE FROM assignments
              WHERE assignmentID = :assignment_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>