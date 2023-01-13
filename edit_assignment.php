<?php

// Get the assignment data
$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$module_id = filter_input(INPUT_POST, 'module_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$note = filter_input(INPUT_POST, 'note');
$type = filter_input(INPUT_POST, 'type');
$due_date = filter_input(INPUT_POST, 'due_date');
$submit_date = filter_input(INPUT_POST, 'submit_date');
$grade = filter_input(INPUT_POST, 'grade', FILTER_VALIDATE_FLOAT);
//print $submit_date;
//die();

// Validate inputs
if ($assignment_id == NULL || $assignment_id == FALSE || $module_id == NULL ||
$module_id == FALSE || empty($name) ||
$name == null || $note == null || $type == null || $due_date == null || $submit_date == null) {
$error = "Invalid assignment data. Check all fields and try again.";
include('error.php');
} else {

// If valid, update the assignment in the database
require_once('database.php');

$query = "UPDATE assignments
SET moduleID = :module_id,
name = :name,
note = :note,
type = :type,
due_date = :due_date,
submit_date = :submit_date,
grade = :grade

WHERE assignmentID = :assignment_id";

$statement = $db->prepare($query);
$statement->bindValue(':module_id', $module_id);
$statement->bindValue(':name', $name);
$statement->bindValue(':note', $note);
$statement->bindValue(':type', $type);
$statement->bindValue(':due_date', $due_date);
$statement->bindValue(':submit_date', $submit_date);
$statement->bindValue(':grade', $grade);
$statement->bindValue(':assignment_id', $assignment_id);
$statement->execute();
$statement->closeCursor();

// Display the Assignment List page
include('index.php');
}
?>