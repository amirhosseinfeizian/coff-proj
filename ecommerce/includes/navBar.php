<?php

// var_dump($_SESSION);

?>
<!--Navigation bar start-->
<nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-color:rgb(112, 79, 79)">
    <div class="container">
        <a href="index.php" class="navbar-brand">coffee khorasgan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="products.php" class="nav-link"> Products </a></li>
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
                    <?php
                }
                ?>
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    ?>
                    <li class="nav-item"><a href="users.php" class="nav-link">UsersList</a></li>
                    <?php
                }
                ?>
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    ?>
                    <li class="nav-item"><a href="products-list.php" class="nav-link">ProductsList</a></li>
                    <?php
                }
                ?>
                <?php
                if (isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    ?>
                    <li class="nav-item"><a href="add-product.php" class="nav-link">AddProduct</a></li>
                    <?php
                }
                ?>
            </ul>


            <div style="margin-right: 10px">
                <form action="search.php" method="get">
                    <input type="text" name="query" placeholder="Search..."
                           value="<?php echo isset($_GET['query'])? $_GET['query'] : null ;?>">
                    <input type="submit" value="Search">
                </form>
            </div>


            <?php
            if (isset($_SESSION['email'])) {
                ?>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-sign-out"></i>Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link show-on-hover-a" data-placement="bottom" data-toggle="popover"
                           data-trigger="hover" data-content="<?php echo $_SESSION['email'] ?>">
                            <i class="fa fa-user-circle"></i>
                        </a>
                    </li>
                </ul>
                <?php
            } else {
                ?>
                <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item ">
                        <a href="login.php" class="nav-link" data-toggle="modal"><i class="fa fa-user">
                            </i> sign In
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="signup.php" class="nav-link" data-toggle="modal"><i class="fa fa-sign-in">
                            </i> signup
                        </a>
                    </li>
                </ul>

                <?php
            }
            ?>
        </div>
    </div>
    </div>
</nav>
<!--navigation bar end-->