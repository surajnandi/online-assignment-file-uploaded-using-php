
<?php
session_start();
include "../config/connection.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$sql = mysqli_query($conn, "update users set status='A' where id = '$id'"); // restore query


if ($sql) {
    mysqli_close($conn); // Close connection
    $_SESSION['status_text'] = "Restore!";
    $_SESSION['status'] = "Data Recovery Successfully.";
    $_SESSION['status_code'] = "success";
    header("location:temp-files.php"); // redirects to all records page
    exit;
} else {
    echo "Error  record"; // display error message if not delete
}
?>