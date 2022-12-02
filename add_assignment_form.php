<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
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

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            
            <label>Name:</label>
            <input type="input" name="name">
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
            
            <!--<label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>-->
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Assignment">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>