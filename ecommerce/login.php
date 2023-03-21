<?php
require "utils/db.php";
session_start();

//if (isset($_SESSION['email'])) {
//    header('location: profile.php');
//}

if (isset($_POST['lemail'])) {
    $email = $_POST['lemail'];
    $email = mysqli_real_escape_string($connection, $email);

    $password = $_POST['lpassword'];
    $password = mysqli_real_escape_string($connection, $password);
    $password = md5($password);

    $query = "SELECT id,email_id,password,role from users where email_id='" . $email . "' and  password='" . $password . "'";
    $result = mysqli_query($connection, $query);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
        $m = "Please enter correct E-mail id and Password";
        header('location: login.php?errorl=' . $m);
    } else {
        $row = mysqli_fetch_array($result);
        $_SESSION['email'] = $row['email_id'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header('location:products.php');
    }
}
require("includes/header.php");
?>

<div class="" id="login">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">

            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
            </div>

            <div class="modal-body">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="lemail" placeholder="Enter email" required>
                        <?php if(isset($_GET['errorl'])){ echo "<span class='text-danger'>".$_GET['errorl']."</span>" ;}  ?>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="lpassword" placeholder="Password"
                               required>
                        <?php if(isset($_GET['errorl'])){ echo "<span class='text-danger'>".$_GET['errorl']."</span>" ;}  ?>
                    </div>

                    <button type="submit" class="btn btn-success btn-block" name="Submit">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mr-auto">New User? <a href="signup.php" data-toggle="modal" data-dismiss="modal">signup</a></p>

            </div>
        </div>
    </div>
</div>
<!--Login trigger Model ends-->

<?php require("includes/footer.php"); ?>
