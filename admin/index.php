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
            $error = "<p class='text-center text-danger' role='alert'>
Email/Password is incorrect.</p>";
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

        #show_eye {
            cursor: pointer;
        }

        #hide_eye {
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

                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="login" autocomplete="off" class="bg-light border p-3">
                                        <?= $error; ?>
                                        <div class="form-row">

                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input name="email" type="email" required value="<?php if (isset($_POST['email'])) {
                                                                                                            echo htmlentities($_POST['email']);
                                                                                                        } ?>" class="input form-control" id="username" placeholder="Enter Email Address" aria-label="Email" aria-describedby="basic-addon1" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input name="password" type="password" value="" class="input form-control" id="password" placeholder="password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="password_show_hide();">
                                                            <i class="fas fa-eye" id="show_eye"></i>
                                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group form-check text-left">
                                                    <input type="checkbox" name="remember" class="form-check-input" id="remember_me" />
                                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-12 pt-3 text-right">
                                                <p>Already registered <a href="#">Register</a></p>
                                            </div> -->
                                            <div class="col-12">
                                                <button class="btn btn-block btn-primary" type="submit" name="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
                                            </div>
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

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>

</body>

</html>