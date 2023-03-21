<?php
require "utils/db.php";
session_start();

//if (isset($_SESSION['email'])) {
//    header('location: profile.php');
//}

if (isset($_POST['eMail'])) {
    $email = $_POST['eMail'];
    $email = mysqli_real_escape_string($connection, $email);

    $pass = $_POST['password'];
    $pass = mysqli_real_escape_string($connection, $pass);
    $pass = md5($pass);

    $first = $_POST['firstName'];
    $first = mysqli_real_escape_string($connection, $first);

    $last = $_POST['lastName'];
    $last = mysqli_real_escape_string($connection, $last);

//    echo $email; echo '<br>';
//    echo $pass; echo '<br>';
//    echo $first; echo '<br>';
//    echo $last; echo '<br>';
//    die();

    $query = "SELECT * from users where email_id='$email'";
    $result = mysqli_query($connection, $query);
    $num = mysqli_num_rows($result);
    if ($num != 0) {
        $m = "Email Already Exists";
        header('location: signup.php?error=' . $m);
    } else {
        $quer = "INSERT INTO users(email_id,role,first_name,last_name,password) values('$email','user','$first','$last','$pass')";
        mysqli_query($connection, $quer);

        echo "New record has id: " . mysqli_insert_id($connection);
        $user_id = mysqli_insert_id($connection);
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;
        header('location:products.php');
    }
}
?>

<?php require("includes/header.php"); ?>

<!--Signup model start-->
<div class="" id="signup">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">

            <div class="modal-header">
                <h5 class="modal-title">Sign Up</h5>
            </div>

            <div class="modal-body">
                <form action="signup.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control"  name="eMail" placeholder="Enter email" required>
                        <?php if(isset($_GET['error'])){ echo "<span class='text-danger'>".$_GET['error']."</span>" ;}  ?>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="validation1">First Name</label>
                            <input type="text" class="form-control" id="validation1" name="firstName" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md -6">
                            <label for="validation2">Last Name</label>
                            <input type="text" class="form-control" id="validation2" name="lastName" placeholder="Last Name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="Submit">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mr-auto">Already Registered?<a href="login.php"  data-toggle="modal" data-dismiss="modal">Login</a></p>
            </div>
        </div>
    </div>
</div>
<!--Signup trigger model ends-->

<?php require("includes/footer.php"); ?>