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

/**************************** Image upload ****************************/

/*
$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');

if ($imgFile) {
$upload_dir = 'image_uploads/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
if (filter_input(INPUT_POST, 'original_image') !== "") {
unlink($upload_dir . $original_image);                    
}
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// if no image selected the old image remain as it is.
$image = $original_image; // old image from database
}

*/
/************************** End Image upload **************************/

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