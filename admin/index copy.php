<?php
session_start();
include '../config/connection.php';

if (isset($_SESSION['IS_LOGIN'])) {
    header('location:dashboard.php');
    die();
}

$error = '';


if (isset($_POST["submit"])) {


    // validate username empty
    if (isset($_POST['email']) && empty($_POST['email'])) {
        $error .= "<div class='alert alert-danger text-center' role='alert'>
Name is invalid, please try again.</div>";
    } else {
        // validate
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['email'])) {
            $error  .= "<div class='alert alert-success text-center' role='alert'>
Name is valid.</div>";
        }
    }
    // validate password empty
    if (isset($_POST['password']) && empty($_POST['password'])) {
        $error .= "<div class='alert alert-danger text-center' role='alert'>
Password is invalid, please try again.</div>";
    } else {
        // validate
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST['password'])) {
            $error  .= "<div class='alert alert-success text-center' role='alert'>
Password is valid.</div>";
        }
    }
    //variables declaration
    // $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (trim($email) != "" and trim($password) != "") {
        //Sanitizes whatever is entered
        $email = stripcslashes($email);
        $password = stripcslashes($password);
        $email = strip_tags($_POST["email"]);
        $password = strip_tags($_POST["password"]);


        // $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);


        //SQL Query
        $query = mysqli_query($conn, "SELECT * FROM admin WHERE 
email='$email' AND password ='$password'");
        //applay mysqli
        $numrows = mysqli_num_rows($query);
        if ($numrows > 0) {
            $row = mysqli_fetch_assoc($query);
            //session email 
            $_SESSION['IS_LOGIN'] = true;
            // $_SESSION["email"] = $email;
            // $_SESSION["name"] = $name;
            $_SESSION['name'] = $row['name'];

            $error = "<div class='alert alert-success text-center' role='alert'>
            Login is Successfull.</div>";

            header('location:dashboard.php');
            die();
        } else {
            $error = "<div class='alert alert-danger text-center' role='alert'>
Email/Password is incorrect.</div>";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Login</title>
    <link href="../assets/theme/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-5" style="margin-top: 30px;">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"><i class="fas fa-user-lock"></i> Admin Login</h3>
                                </div>

                                <div class="card-body">
                                    <form id="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                        <?= $error; ?>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" required value="<?php if (isset($_POST['email'])) {
                                                                                                                                                                                    echo htmlentities($_POST['email']);
                                                                                                                                                                                } ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="password" name="password" type="password" placeholder="Enter password" required />

                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-3">
                                            <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                            <button type="submit" name="submit" class="btn btn-block btn-primary" value=""><i class="fas fa-sign-in-alt"></i> Login</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../assets/theme/js/scripts.js"></script>


</body>

</html>