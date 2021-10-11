<?php session_start(); ?>

<?php
include_once '../config/connection.php';

// $sql = "DELETE FROM users WHERE id='" . $_GET["id"] . "'";
// if (mysqli_query($conn, $sql)) {
//     $_SESSION['status_text'] = "Are you sure?";
//     $_SESSION['status'] = "This record and it`s details will be permanantly deleted!";
//     $_SESSION['status_code'] = "warning";
//     header("Location: dashboard.php");
//     exit();
// } else {
//     echo "Error deleting record: " . mysqli_error($conn);
// }
// mysqli_close($conn);

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "UPDATE users set status='D' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        // $_SESSION['status_text'] = "Are you sure?";
        // $_SESSION['status'] = "This record and it`s details will be permanantly deleted!";
        // $_SESSION['status_code'] = "warning";
        // echo '<script>alert("Deleted")</script>';
        // echo "Deleted";
        // header("Location: dashboard.php");
        // exit();


        // Start the session if already not started.
        // session_start();
        // $_SESSION['success_message'] = "Record Deleted Successfully.";
        // header("Location: dashboard.php");
        // exit();
        session_start();
        $_SESSION['status_text'] = "Record Deleted Successfully.";
        $_SESSION['status'] = "oii";
        $_SESSION['status_code'] = "success";
        header("Location: dashboard.php");
        exit();
    } else {

        // echo '<script>alert("Not Deleted")</script>';
    }
}

// $id = $_POST['del_id'];
// // $sql = "UPDATE users set status='D' WHERE id='$id'";
// // mysqli_query($conn, $sql);

// $query = mysqli_query($conn, "UPDATE users set status='D' WHERE id='$id'");


// if (isset($_POST['id'])) {
//     $id =  $_POST['id'];

//     $sql = "DELETE FROM posts WHERE id=" . $id;
//     mysqli_query($conn, $sql);
//     echo 1;
//     exit;
// }

// echo 0;
// exit;


?>


