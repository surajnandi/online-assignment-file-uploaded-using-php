
<?php
session_start();
include "../config/connection.php"; // Using database connection file here

if (isset($_POST['delete_btn_set'])) {
    $del_id = $_POST['delete_id'];
    $sql = mysqli_query($conn, "DELETE FROM users WHERE id = '$del_id'");
}
?>