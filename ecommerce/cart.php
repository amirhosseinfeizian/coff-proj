<?php
require "utils/db.php";
session_start();

if (!isset($_SESSION['email'])) {
    // header('location: index.php');
}
?>

<?php require('./includes/header.php'); ?>

<div class="d-flex justify-content-center">
    <div class=" col-md-6  my-5 table-responsive p-5">
        <table class="table table-striped table-bordered table-hover ">
            <?php
            $sum = 0;
            $user_id = $_SESSION['user_id'];
            $query = " SELECT products.price AS Price, products.id, products.name AS Name FROM users_products JOIN products ON users_products.item_id = products.id WHERE users_products.user_id='$user_id' and status='Added To Cart'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) >= 1) {
                ?>
                <thead>
                <tr>
                    <th>Item Number</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $sum += $row["Price"];
                    $id = $row["id"] . ", ";
                    echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["Name"] . "</td><td>$" . $row["Price"] . "</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                }
                $id = rtrim($id, ", ");
                echo "<tr><td></td><td>Total</td><td>$" . $sum . "</td><td><a href='cart-remove.php?success=true' class='btn btn-primary'>Confirm Order</a></td></tr>";
                ?>
                </tbody>
                <?php
            } else {
                echo "<div> <img src='./assets/images/emptycart.png' class='image-fluid' height='150' width='150'></div><br/>";
                echo "<div class='text-bold  h5'>Add items to the cart first!<div>";

            }
            ?>
            <?php
            ?>

            </tbody>
        </table>
    </div>
</div>
</div>
<?php require('./includes/footer.php'); ?>
