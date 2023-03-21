<?php
require "utils/db.php";
session_start();

if ($_SESSION['role'] != 'admin') {
    header('location: index.php');
}

if (isset($_GET['product_id_delete'])) {
    $product_id_delete = $_GET['product_id_delete'];

    $query = "DELETE FROM products WHERE id=" . "$product_id_delete";
    $result = mysqli_query($connection, $query);

    if (mysqli_query($connection, $query)) {
        echo "Record deleted successfully";
        //echo "New record created successfully";
        $m = "Record deleted successfully";
        header('location: products-list.php?success_delete=' . $m);
    } else {
        $m = "Some error occurred";
        header('location: products-list.php?error_delete=' . $m);
    }
}

$query = "SELECT * from products";
$result = mysqli_query($connection, $query);
?>

<?php require('./includes/header.php'); ?>

<div class="container" style="margin-top:75px;">
    <div class="row text-center">
        <div class="w-100 text-center m-3">
            <h2 class="text-center">Products List</h2>
        </div>

        <?php
        if (isset($_GET['success_delete'])) {
            echo "<div class='form-message w-100'> " . $_GET['success_delete'] . "</div>";
        }
        ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td><img src="<?php echo $row['image'] ?>" alt="" style="width: 15%"></td>
                        <td>
                            <form action="" method="get">
                                <input type="text" name="product_id_delete" value="<?php echo $row['id'] ?>" hidden>
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "No users found.";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php require('./includes/footer.php'); ?>
