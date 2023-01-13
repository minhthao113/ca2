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
        <h1>Add Assignment</h1>
        <form action="add_assignment.php" method="post" enctype="multipart/form-data"
              id="add_assignment_form">

            <label>Module:</label>
            <select name="module_id" required>
            <?php foreach ($modules as $module) : ?>
                <option value="">None</option>
                <option value="<?php echo $module['moduleID']; ?>">
                    <?php echo $module['moduleName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            
            <label>Name:</label>
            <input type="input" name="name" placeholder="Enter assignment name" required>
            <br>

            <label>Note (optional):</label>
            <input type="input" name="note" placeholder="Enter assignment description">
            <br>        

            <label>Type:</label>
            <input type="radio" name="type" value="Recoverable">
            <label>Recoverable</label>
            <input type="radio" name="type" value="Non-Recoverable">
            <label>Non-Recoverable</label>
            <br>  

            <label>Due date:</label>
            <input type="date" name="due_date" required>
            <br>  

            <label>Submit date:</label>
            <input type="date" name="submit_date" required>
            <br> 
            
            <label>Grade (%):</label>
            <input type="input" name="grade" placeholder="Enter a mark from 1 to 100">
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Assignment">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>