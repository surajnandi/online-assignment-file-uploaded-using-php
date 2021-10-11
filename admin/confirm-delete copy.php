
<?php
session_start();
include "../config/connection.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$sql = mysqli_query($conn, "delete from users where id = '$id'"); // delete query


if ($sql) {
    mysqli_close($conn); // Close connection
    header("location:temp-files.php"); // redirects to all records page
    exit;
} else {
    echo "Error  record"; // display error message if not delete
}
?>