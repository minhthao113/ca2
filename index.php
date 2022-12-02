<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get assignments for selected category
$queryRecords = "SELECT * FROM assignments
WHERE categoryID = :category_id
ORDER BY assignmentID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$assignments = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1>Assignment List</h1>

<aside>
<!-- display a list of categories -->
<h2>Categories</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of assignments -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<!--<th>Image</th>-->
<th>Name</th>
<th>Note (optional)</th>
<th>Type</th>
<th>Due date</th>
<th>Submit date</th>
<th>Grade</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($assignments as $assignment) : ?>
<tr>
<!--<td><img src="image_uploads/<?php echo $assignment['image']; ?>" width="100px" height="100px" /></td>-->
<td><?php echo $assignment['name']; ?></td>
<td><?php echo $assignment['note']; ?></td>
<td><?php echo $assignment['type']; ?></td>
<td><?php echo $assignment['due_date']; ?></td>
<td><?php echo $assignment['submit_date']; ?></td>
<td><?php echo $assignment['grade']; ?></td>
<td><form action="delete_assignment.php" method="post"
id="delete_record_form">
<input type="hidden" name="assignment_id"
value="<?php echo $assignment['assignmentID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $assignment['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="assignment_id"
value="<?php echo $assignment['assignmentID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $assignment['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_assignment_form.php">Add Assignment</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>