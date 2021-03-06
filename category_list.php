<?php
session_start();
/*
 * Check if the user is logged in.
 */
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}




/*
 * Print out something that only logged in users can see.
 */
echo 'Congratulations! You are logged in!';
require_once('database.php');
?>


<?php
// Get all categories
$query = 'SELECT * FROM categories
              ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->

<div style="background-image: url('image_uploads/background.jpg');">

<div class="container">
    <?php
    include('includes/header.php');
    ?>
    <h1 id="categorylist-heading">Coffee List</h1>
    <table id="table">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category['categoryName']; ?></td>
                <td>
                    <form action="delete_category.php" method="post" id="delete_product_form">
                        <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <h2 id="addcoffee-heading">Add Coffee</h2>
    <form action="add_category.php" method="post" id="add_category_form">

        <label id="th">Name:</label>
        <input type="input" name="name">
        <input type="submit" value="Add">
    </form>

    <?php
    include('includes/footer.php');
    ?>