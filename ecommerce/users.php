<?php
require "utils/db.php";
session_start();

if ($_SESSION['role'] != 'admin') {
    header('location: index.php');
}

$query = "SELECT * from users";
$result = mysqli_query($connection, $query);
?>

<?php require('./includes/header.php'); ?>

<div class="container" style="margin-top:75px;">
    <div class="row text-center">
        <div class="w-100 text-center m-3">
            <h2 class="text-center">Users List</h2>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['email_id'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td><?php echo $row['first_name'] ?></td>
                        <td><?php echo $row['last_name'] ?></td>
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
