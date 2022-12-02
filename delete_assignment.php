<?php
require_once('database.php');

// Get IDs
$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($assignment_id != false && $category_id != false) {
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