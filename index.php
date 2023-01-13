<?php
require_once('database.php');

// Get module ID
if (!isset($module_id)) {
$module_id = filter_input(INPUT_GET, 'module_id', 
FILTER_VALIDATE_INT);
if ($module_id == NULL || $module_id == FALSE) {
$module_id = 1;
}
}

// Get name for current module
$queryCategory = "SELECT * FROM modules
WHERE moduleID = :module_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':module_id', $module_id);
$statement1->execute();
$module = $statement1->fetch();
$statement1->closeCursor();
$module_name = $module['moduleName'];

// Get all modules
$queryAllCategories = 'SELECT * FROM modules
ORDER BY moduleID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$modules = $statement2->fetchAll();
$statement2->closeCursor();

// Get assignments for selected module
$queryRecords = "SELECT * FROM assignments
WHERE moduleID = :module_id
ORDER BY assignmentID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':module_id', $module_id);
$statement3->execute();
$assignments = $statement3->fetchAll();
$statement3->closeCursor();
?>

<?php
include('includes/header.php');
?>

<aside>
<!-- display a list of modules -->
<h2>Modules</h2>
<nav>
<p><a href="module_list.php">Manage Modules</a></p>
<hr>
<ul>
<?php foreach ($modules as $module) : ?>
<li><a href=".?module_id=<?php echo $module['moduleID']; ?>">
<?php echo $module['moduleName']; ?>
<hr>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<div class="container">
<section>
<!-- display a table of assignments -->
<h2><?php echo $module_name; ?></h2>
<table>
<tr>
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
id="delete_assignment_form">
<input type="hidden" name="assignment_id"
value="<?php echo $assignment['assignmentID']; ?>">
<input type="hidden" name="module_id"
value="<?php echo $assignment['moduleID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_assignment_form.php" method="post"
id="delete_assignment_form">
<input type="hidden" name="assignment_id"
value="<?php echo $assignment['assignmentID']; ?>">
<input type="hidden" name="module_id"
value="<?php echo $assignment['moduleID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_assignment_form.php">Add Assignment</a></p>
</section>

<?php
include('includes/footer.php');
?>