<?php
require "utils/db.php";
session_start();

if ($_SESSION['role'] != 'admin') {
    header('location: index.php');
}

if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_image_url'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image_url = $_POST['product_image_url'];

    $query = "INSERT INTO products (name, price, image) VALUES ('" . $product_name . "', '" . $product_price . "', '" . $product_image_url . "')";
    $result = mysqli_query($connection, $query);

    if ($result === TRUE) {
        //echo "New record created successfully";
        $m = "Product was added successfully";
        header('location: add-product.php?success_form=' . $m);
    } else {
        //echo "Error: " . "<br>" . mysqli_error($connection);
        $m = "Some error occurred";
        header('location: add-product.php?error_form=' . $m);
    }
}
?>

<?php require('./includes/header.php'); ?>

<div class="container" style="margin-top:75px;">
    <div class="row text-center">
        <div class="w-100 text-center m-3">
            <h2 class="text-center">Add A Product</h2>
        </div>
        <div class="w-100 text-left add-product-form-container">
            <?php
            if (isset($_GET['success_form'])) {
                echo "<div class='form-message'> Product was added successfully</div>";
            }
            ?>

            <form action="" method="post">
                <div class="add-product-input-div form-group">
                    <label for="product_name">Enter the product name:</label>
                    <input type="text" name="product_name" id="product_name" placeholder="Product Name" required>
                    <?php
                    if (isset($_GET['error_form'])) {
                        echo "<span class='text-danger'>" . $_GET['error_form'] . "</span>";
                    }
                    ?>
                </div>

                <div class="add-product-input-div">
                    <label for="product_price">Enter the product price:</label>
                    <input type="text" name="product_price" id="product_price" placeholder="Product Price" required>
                    <?php
                    if (isset($_GET['error_form'])) {
                        echo "<span class='text-danger'>" . $_GET['error_form'] . "</span>";
                    }
                    ?>
                </div>

                <div class="add-product-input-div">
                    <label for="product_image_url">Enter the product image URL:</label>
                    <input type="text" name="product_image_url" id="product_image_url" placeholder="Product Image URL"
                           required>
                    <?php
                    if (isset($_GET['error_form'])) {
                        echo "<span class='text-danger'>" . $_GET['error_form'] . "</span>";
                    }
                    ?>
                </div>

                <div class="add-product-input-div" style="margin-top: 3rem;">
                    <input class="btn btn-success btn-block" type="submit" value="Add Product" style="height: 50px">
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('./includes/footer.php'); ?>
