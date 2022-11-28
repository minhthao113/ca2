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

// Get pets for selected category
$queryRecords = "SELECT * FROM pets
WHERE categoryID = :category_id
ORDER BY petID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$pets = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1>Pet List</h1>

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
<!-- display a table of pets -->
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
<?php foreach ($pets as $pet) : ?>
<tr>
<!--<td><img src="image_uploads/<?php echo $pet['image']; ?>" width="100px" height="100px" /></td>-->
<td><?php echo $pet['name']; ?></td>
<td><?php echo $pet['note']; ?></td>
<td><?php echo $pet['type']; ?></td>
<td><?php echo $pet['due_date']; ?></td>
<td><?php echo $pet['submit_date']; ?></td>
<td><?php echo $pet['grade']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="pet_id"
value="<?php echo $pet['petID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $pet['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="pet_id"
value="<?php echo $pet['petID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $pet['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>