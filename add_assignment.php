<?php

// Get the product data
$module_id = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$note = filter_input(INPUT_POST, 'note');
$type = filter_input(INPUT_POST, 'type');
$due_date = filter_input(INPUT_POST, 'due_date');
$submit_date = filter_input(INPUT_POST, 'submit_date');
$grade = filter_input(INPUT_POST, 'grade', FILTER_VALIDATE_FLOAT);

// Validate inputs
if ($module_id == null || $module_id == false ||
    $name == null || $note == null || $type == null || $due_date == null || $submit_date == null || $grade == null || $grade == false ) {
    $error = "Invalid assigment data. Check all fields and try again.";
    include('error.php');
    exit();
} else {

    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO assignments
                 (moduleID, name, note, type, due_date, submit_date, grade)
              VALUES
                 (:module_id, :name, :note, :type, :due_date, :submit_date, :grade)";
    $statement = $db->prepare($query);
    $statement->bindValue(':module_id', $module_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':note', $note);
    $statement->bindValue(':type', $type);
    $statement->bindValue(':due_date', $due_date);
    $statement->bindValue(':submit_date', $submit_date);
    $statement->bindValue(':grade', $grade);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}