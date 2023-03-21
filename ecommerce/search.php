<?php
require "utils/db.php";
session_start();

if (!isset($_GET['query'])) {
    header('location: index.php');
}

$query = "SELECT * FROM products WHERE name LIKE '%" . $_GET['query'] . "%'";
$result = mysqli_query($connection, $query);

require('./includes/header.php');

?>
<div class="container" style="margin-top:75px;">
    <div class="row text-center">
        <div class="w-100 text-center m-3">
            <h2 class="text-center">Products Search Result</h2>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><img src="<?php echo $row['image'] ?>" alt="" style="width: 15%"></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="4">No Product Found</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php require('./includes/footer.php'); ?>
