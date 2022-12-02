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

    /**************************** Image upload ****************************/

    error_reporting(~E_NOTICE); 

// avoid notice

/*    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    echo $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if (empty($imgFile)) {
        $image = "";
    } else {
        $upload_dir = 'image_uploads/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $image = rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
            if ($imgSize < 5000000) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $image)) {
                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    $error =  "Sorry, there was an error uploading your file.";
                    include('error.php');
                    exit();
                }
            } else {
                $error = "Sorry, your file is too large.";
                include('error.php');
                exit();
            }
        } else {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            include('error.php');
            exit();
        }
    }
    */

    /************************** End Image upload **************************/
    
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