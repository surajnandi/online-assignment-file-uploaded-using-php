<?php
session_start();
error_reporting(E_ALL);
include('../config/connection.php');

if (isset($_POST['update'])) {

    // echo "user profile";

    // $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $updated_at = date("Y-m-d H:i:s");

    if (!empty($name) && !empty($email) && !empty($username) && !empty($password)) {

        $loginUser = $_SESSION['name'];
        $sql = "UPDATE admin SET name = '$name', email='$email', username='$username', password='$password', updated_at='$updated_at' WHERE name = '$loginUser'";

        $result = mysqli_query($conn, $sql);

        // header('location:profile.php?success=adminprofileupdated');
        // exit;

        unset($_SESSION['IS_LOGIN']);
        header('location:index.php');
        die();
    } else {
        header('location:profile.php?error=emptyfileds');
        exit();
    }
}
