<?php
// Get the module data
$name = $name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($name == null) {
    $error = "Invalid module data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database
    $query = "INSERT INTO modules (moduleName)
              VALUES (:name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();

    // Display the module List page
    include('module_list.php');
}
?>