<?php
// error_reporting(0);
session_start();

include('../config/connection.php');

if (!isset($_SESSION['IS_LOGIN'])) {
    header('location:index.php');
    die();
}
// echo "Welcome " . $_SESSION['name'];

require('./header.php');
require('./navbar.php');


// session_start();
// $id = $_SESSION['id'];
// $query = mysqli_query($conn, "SELECT * FROM admin where id='$id'") or die(mysqli_error($conn));
// $row = mysqli_fetch_array($query);

// if (isset($_POST['submit'])) {
//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $updated_at = date("Y-m-d H:i:s");

//     mysqli_query($conn, "UPDATE admin SET name = '$name',
//                       email = '$email', username = $username, password = '$password', updated_at = '$updated_at'
//                       WHERE id = '$id'");
//     $_SESSION['message'] = "Profile updated!";
//     // header('location: profile.php');
// }



?>



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Admin Profile</h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Temporary Files</li>
            </ol> -->


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Update Admin Profile
                </div>

                <div class="card-body">
                    <?php
                    if (isset($_GET['success'])) {
                    ?>
                        <h1 class="alert btn btn-block alert-success">Admin Profile Updated Successfully.</h1>

                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_GET['error'])) {
                    ?>
                        <h1 class="alert btn btn-block alert-danger">All fields are required</h1>

                    <?php
                    }
                    ?>

                    <br>
                    <form method="POST" action="update-profile.php" class="needs-validation" novalidate>


                        <?php
                        $admin_name = $_SESSION['name'];
                        $sql = "select * from admin where name ='$admin_name'";
                        $result = mysqli_query($conn, $sql);
                        // $row = mysqli_fetch_array($result);
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    // print_r($row['name']);
                                    // die();
                        ?>


                                    <!-- <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> -->
                                    <div class="form-row">

                                        <!-- <div class="col-md-6 mb-3">
                                <label for="validationCustom01">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="" required>
                                <div class="valid-feedback">

                                </div>
                            </div> -->
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustomUsername">Name</label><span style="color: red;">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user-tie"></i></span>
                                                </div>
                                                <input type="text" name="name" class="form-control" id="validationCustomUsername" placeholder="Name" aria-describedby="inputGroupPrepend" required value="<?php echo $row['name']; ?>">
                                                <div class="invalid-feedback">
                                                    Please enter name.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustomUsername">Username</label><span style="color: red;">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-at"></i></span>
                                                </div>
                                                <input type="text" name="username" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required value="<?php echo $row['username']; ?>">
                                                <div class="invalid-feedback">
                                                    Please enter username.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustomUsername">Email</label><span style="color: red;">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text" name="email" class="form-control" id="validationCustomUsername" placeholder="Email" aria-describedby="inputGroupPrepend" required value="<?php echo $row['email']; ?>">
                                                <div class="invalid-feedback">
                                                    Please enter email
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustomUsername">Password</label><span style="color: red;">*</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-unlock-alt"></i></span>
                                                </div>
                                                <input type="text" name="password" class="form-control" id="validationCustomUsername" placeholder="Password" aria-describedby="inputGroupPrepend" required value="<?php echo $row['password']; ?>">
                                                <div class="invalid-feedback">
                                                    Please enter password
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <div class="form-check">
                                            <p style="color: red;">Note : After update your profile this page will be redirect to login page.</p>
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>

                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before updating.
                                            </div>
                                        </div>
                                    </div>
                                    <input class="col-sm-12 col-md-2 btn btn-primary mt-3" name="update" type="submit" value="Update">


                        <?php
                                }
                            }
                        }
                        ?>



                    </form>


                </div>
            </div>
        </div>
    </main>





    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <?php require('./footer.php'); ?>