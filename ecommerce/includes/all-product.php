<?php
session_start();

require "utils/db.php";
require("./includes/header.php");
include './includes/check-if-added.php';

$query = "SELECT * from products";
$result = mysqli_query($connection, $query);

?>


    <div class="container" style="margin-top:65px">
        <!--jumbutron start-->
        <div class="jumbotron text-center" style="background-color: rgb(85, 57, 57, 0.6);">
            <h1>Products</h1>
            <p>The best ecommerce website in the galaxy!</p>
        </div>
        <!--jumbutron ends-->

        <hr/>
        <!--menu list-->
        <div class="row text-center" id="watch">

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 col-6 py-2">
                        <div class="card">
                            <img src="<?php echo $row['image'] ?>" alt="" class="img-fluid pb-1">
                            <div class="figure-caption">
                                <h6><?php echo $row['name'] ?></h6>
                                <h6>Price: $<?php echo $row['price'] ?></h6>
                                <?php if (!isset($_SESSION['email'])) { ?>
                                    <p>
                                        <a href="login.php" role="button" class="btn btn-warning  text-white ">
                                            Add To Cart
                                        </a>
                                    </p>
                                    <?php
                                } else {
                                if (check_if_added_to_cart($row['id'])) {
                                    echo '<p><a href="#" class="btn btn-warning  text-white" disabled>
                                    Added to cart
                                    </a></p>';
                                } else {
                                ?>
                                <p>
                                    <a href="cart-add.php?id=<?php echo $row['id']?>" name="add" value="add"
                                       class="btn btn-warning  text-white">
                                        Add To Cart
                                    </a>
                                <p>
                                    <?php
                                    }
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "0 results";
            }
            ?>

        </div>

    </div>

<?php
require("./includes/footer.php");