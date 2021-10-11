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
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "UPDATE users set status='D' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {

        // Start the session if already not started.
        // session_start();
        // $_SESSION['success_message'] = "Record Deleted Successfully.";
        // header("Location: dashboard.php");
        // exit();

        // session_start();
        $_SESSION['status_text'] = "Delete!";
        $_SESSION['status'] = "Record Deleted Successfully.";
        $_SESSION['status_code'] = "success";
        // header("Location: dashboard.php");
        // exit();
        // header('Location: http://localhost/php_projects/php_file/admin/dashboard.php');
        // die;

    } else {

        // echo '<script>alert("Not Deleted")</script>';
    }
}


// fetch files
$sql = "select * from users where status='A'";
$result = mysqli_query($conn, $sql);
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <!-- <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->

            <!-- <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
            <?php
                        unset($_SESSION['success_message']);
                    }
            ?> -->

            <!-- <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Primary Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area mr-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div> -->


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Student Details with Assignment Files
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Submitted Date</th>
                                    <th>Download File</th>
                                    <th>Action</th>
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
                                    <tr style="text-align: center;">
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td><?php echo date("d-m-Y h:i:s", strtotime($row['submitted_date'])); ?></td>
                                        <td><a class="btn btn-success" href="../uploads/<?php echo $row['document']; ?>" target="_blank"><i class="fas fa-file-pdf"></i> Download PDF</a></td>

                                        <td><a id="" class="btn btn-danger delete-confirm" href="?id=<?php echo $row['id']; ?>&type=delete"><i class="fas fa-trash-alt"></i> Delete</a></td>
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


    <?php require('./footer.php'); ?>