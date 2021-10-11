<?php
session_start();
include('../config/connection.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $updated_at = date("Y-m-d H:i:s");

    // mysqli_query($conn, "UPDATE admin SET name = '$name',
    //                   email = '$email', username = $username, password = '$password', updated_at = '$updated_at'
    //                   WHERE id = $id");

    $result = mysqli_query($conn, "UPDATE admin SET name = '$name',
                      email = '$email', username = $username, password = '$password', updated_at = '$updated_at' WHERE id='$id'");

    //   UPDATE users SET full_name = '$fullname',
    //   gender = '$gender', age = $age, address = '$address'
    //   WHERE user_id = '$id'

    // header("Location: index.php");
    $_SESSION['message'] = "Profile updated!";
    header('location: profile.php');
}




?>

<!-- <?php if (isset($_SESSION['message'])) : ?>
    <div class="msg" style="color: green;">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php
        endif ?> -->