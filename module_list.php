<?php
    require_once('database.php');

    // Get all modules
    $query = 'SELECT * FROM modules
              ORDER BY moduleID';
    $statement = $db->prepare($query);
    $statement->execute();
    $modules = $statement->fetchAll();
    $statement->closeCursor();
?>
<!-- the head section -->
<?php
include('includes/header.php');
?>

<div class="container">

    <h1>Module List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($modules as $module) : ?>
        <tr>
            <td><?php echo $module['moduleName']; ?></td>
            <td>
                <form action="delete_module.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="module_id"
                           value="<?php echo $module['moduleID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <h2>Add Module</h2>
    <form action="add_module.php" method="post"
          id="add_module_form">

        <label>Name:</label>
        <input type="input" name="name">
        <input id="add_module_button" type="submit" value="Add">
    </form>
    <br>

<?php
include('includes/footer.php');
?>