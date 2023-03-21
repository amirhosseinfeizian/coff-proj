<?php
//if (!isset($_SESSION['email'])) {
//    header('location: index.php');
//}

if (isset($_GET['slug'])) {
    require("./includes/single-product.php");

} else {
    require("./includes/all-product.php");
}

