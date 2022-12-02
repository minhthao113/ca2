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
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Assignment</h1>
        <form action="edit_assignment.php" method="post" enctype="multipart/form-data"
              id="add_assignment_form">
            <input type="hidden" name="original_image" value="<?php echo $assignments['image']; ?>" />
            <input type="hidden" name="assignment_id"
                   value="<?php echo $assignments['assignmentID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $assignments['categoryID']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $assignments['name']; ?>">
            <br>

            <label>Note (optional):</label>
            <input type="input" name="note">
            <br>        

            <label>Type:</label>
            <input type="input" name="type">
            <br>  

            <label>Due date</label>
            <input type="date" name="due_date">
            <br>  

            <label>Submit date</label>
            <input type="date" name="submit_date">
            <br> 
            
            <label>Grade</label>
            <input type="input" name="grade">
            <br>

       <!-- <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>          
            
            <?php if ($assignments['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $assignments['image']; ?>" height="150" /></p>
            <?php } ?> --> 
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>