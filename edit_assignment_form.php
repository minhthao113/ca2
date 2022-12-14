<?php
require('database.php');

$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM assignments
          WHERE assignmentID = :assignment_id';
$statement = $db->prepare($query);
$statement->bindValue(':assignment_id', $assignment_id);
$statement->execute();
$assignments = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<?php
require('database.php');
$query = 'SELECT *
          FROM modules
          ORDER BY moduleID';
$statement = $db->prepare($query);
$statement->execute();
$modules = $statement->fetchAll();
$statement->closeCursor();
?>

<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Assignment</h1>
        <form action="edit_assignment.php" method="post" enctype="multipart/form-data"
              id="add_assignment_form">
            <!--<input type="hidden" name="original_image" value="<?php echo $assignments['image']; ?>" />-->
            <input type="hidden" name="assignment_id"
                   value="<?php echo $assignments['assignmentID']; ?>">

            <label>Module:</label>
            <select name="module_id">
            <?php foreach ($modules as $module) : ?>
                <option value="<?php echo $module['moduleID']; ?>" <?php if($module['moduleID'] == $assignments['moduleID']) echo "selected" ?>>
                    <?php echo $module['moduleName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $assignments['name']; ?>">
            <br>

            <label>Note (optional):</label>
            <input type="input" name="note"
                   value="<?php echo $assignments['note']; ?>">
            <br>        

            <label>Type:</label>
            <input type="radio" name="type" value="Recoverable" <?php if($assignments['type'] == "Recoverable") {echo "checked";} ?>>
            <label>Recoverable</label>
            <input type="radio" name="type" value="Non-Recoverable" <?php if($assignments['type'] == "Non-Recoverable") {echo "checked";} ?>>
            <label>Non-Recoverable</label>  
            <br>  

            <label>Due date:</label>
            <input type="date" name="due_date"
            value="<?php echo $assignments['due_date']; ?>">
            <br>  

            <label>Submit date:</label>
            <input type="date" name="submit_date"
                   value="<?php echo $assignments['submit_date']; ?>">
            <br> 
            
            <label>Grade (%):</label>
            <input type="input" name="grade"
                   value="<?php echo $assignments['grade']; ?>">
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>