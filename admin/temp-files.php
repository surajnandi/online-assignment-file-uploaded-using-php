<?php
session_start();

include('../config/connection.php');

if (!isset($_SESSION['IS_LOGIN'])) {
    header('location:index.php');
    die();
}
// echo "Welcome " . $_SESSION['name'];

require('./header.php');
require('./navbar.php');


// Delete Record



// fetch files
$sql = "select * from users where status='D'";
$result = mysqli_query($conn, $sql);
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Temporary Files</h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Temporary Files</li>
            </ol> -->


            <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
            <?php
                unset($_SESSION['success_message']);
            }
            ?>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    All Temporary Files
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <!-- <th>Subject</th> -->
                                    <th>Date</th>
                                    <th>Download File</th>
                                    <th>Restore</th>
                                    <th>Confirm Delete</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Date-Time</th>
                                    <th>Download File</th>
                                </tr>
                            </tfoot> -->
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <!-- <td><?php echo $row['subject']; ?></td> -->
                                        <td><?php echo date("d-m-Y", strtotime($row['submitted_date'])); ?></td>
                                        <td><a class="btn btn-success" href="../uploads/<?php echo $row['document']; ?>" target="_blank"><i class="fas fa-file-pdf"></i> Download PDF</a></td>

                                        <!-- <td><a id="" class="btn btn-danger delete-confirm" href="restore.php?id=<?php echo $row["id"]; ?>&type=restore"><i class="fas fa-hourglass-half"></i> Restore</a></td> -->

                                        <td>
                                            <a id="" class="btn btn-warning restore" href="restore.php?id=<?php echo $row['id']; ?>"><i class="fas fa-hourglass-half"></i> Restore</a>
                                        </td>
                                        <td>
                                            <!-- <a id="" class="btn btn-danger delete-confirm" href="confirm-delete.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i> Confirm Delete</a> -->

                                            <input type="hidden" class="delete_id_value" value="<?php echo $row['id']; ?>">
                                            <a id="" class="btn btn-danger delete-confirm" href="javascript:void(0)"><i class="fas fa-trash-alt"></i> Confirm Delete</a>
                                        </td>


                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- sweet alert -->
    <script src="../assets/js/sweetalert.min.js"></script>

    <?php if (isset($_SESSION['status']) && !empty($_SESSION['status'])) { ?>

        <script>
            swal({
                title: "<?php echo $_SESSION['status_text']; ?>",
                text: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "Ok",
            });
        </script>

    <?php
        unset($_SESSION['status']);
    }
    ?>


    <!-- confirm delete -->
    <script>
        $(document).ready(function() {
            $('.delete-confirm').click(function(e) {
                e.preventDefault();
                // console.log("hello");

                var deleteid = $(this).closest("tr").find('.delete_id_value').val();
                // console.log(deleteid);

                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // swal("Poof! Your imaginary file has been deleted!", {
                            //     icon: "success",
                            // });

                            $.ajax({
                                type: "POST",
                                url: "confirm-delete.php",
                                data: {
                                    "delete_btn_set": 1,
                                    "delete_id": deleteid,
                                },

                                success: function(response) {

                                    swal("Poof! Your data has been deleted!", {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();

                                        });

                                }
                            });

                        } else {
                            swal("Your data is safe!");
                        }
                    });


            });
        });
    </script>


    <?php require('./footer.php'); ?>