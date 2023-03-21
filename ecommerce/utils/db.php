<?php
$connection = mysqli_connect("localhost", "root", "", "ecommerce");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
