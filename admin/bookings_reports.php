<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<html>

<head>
</head>
</body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Modal -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark">Bookings Report</h2>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a>Bookings Report</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <form action="#" method="POST">
                            <!--download excel file just type in action="booking_export.php" -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Booking From</label>
                                        <input type="date" name="from_date" value="<?php if (isset($_POST['from_date'])) {
                                            echo $_POST['from_date'];
                                        } else {
                                        } ?>" class="form-control" placeholder="From Date" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Booking To</label>
                                        <input type="date" name="to_date" value="<?php if (isset($_POST['to_date'])) {
                                            echo $_POST['to_date'];
                                        } else {
                                        } ?>" class="form-control" placeholder="To Date" required>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group"></br>
                                        <button type="submit" class="btn btn-outline-info" id="check"
                                            name="check">Report</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($_POST['check'])) { ?>

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4 style="color:blue;">BOOKING LIST :-</h4>
                            <h5>
                                <?php if (isset($_POST['from_date'])) {
                                    $fill_dt = date("d-m-Y", strtotime($_POST['from_date']));
                                    echo $fill_dt;
                                } else {
                                } ?> TO
                                <?php if (isset($_POST['to_date'])) {
                                    $to_date = date("d-m-Y", strtotime($_POST['to_date']));
                                    echo $to_date;
                                } else {
                                } ?>

                            </h5>
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>

                                        <tr>
                                            <th style="text-align:center" hidden>No.</th>
                                            <th style="text-align:center">S.No</th>
                                            <th style="text-align:center">Invoice</th>
                                            <th style="text-align:center">Booking Date</th>
                                            <th style="text-align:center">Name</th>
                                            <th style="text-align:center">Mobile</th>
                                            <th style="text-align:center">Trip Start</th>
                                            <th style="text-align:center">Total Days</th>
                                            <th style="text-align:center">Vehicle Type</th>
                                            <th style="text-align:center">Price</th>
                                            <th style="text-align:center">Route</th>
                                            <th style="text-align:center">Deposite</th>
                                            <th style="text-align:center">Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        if (isset($_POST['from_date']) && isset($_POST['to_date'])) {


                                            if (strtotime($_POST['from_date']) <= strtotime($_POST['to_date'])) {
                                                $from_date = $_POST['from_date'];
                                                $to_date = $_POST['to_date'];

                                                $query = "SELECT * FROM booking WHERE b_book_date BETWEEN '$from_date' AND '$to_date' order by b_book_date ";

                                                $query_run = mysqli_query($con, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    $count = 1;
                                                    foreach ($query_run as $row) {


                                                        ?>
                                                        <tr>
                                                            <td hidden>
                                                                <?php echo $row['b_id']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $count;
                                                                $count++; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $row['b_invoice']; ?>
                                                            </td>
                                                            <td>
                                                                <?php $fill_dt = date("d-m-Y", strtotime($row['b_book_date']));
                                                                echo $fill_dt; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_mobile1']; ?>
                                                            </td>
                                                            <td>
                                                                <?php $fill_dt = date("d-m-Y", strtotime($row['b_trip_start']));
                                                                echo $fill_dt; ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $row['b_total_days']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_type']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_price']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_route']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['b_deposite']; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($row['b_status'] == "0") {
                                                                    echo "<span class='badge badge-danger'>UNPAID</span>";
                                                                } elseif ($row['b_status'] == "1") {
                                                                    echo "<span class='badge badge-warning'>PARTIALLY PAID</span>";
                                                                } elseif ($row['b_status'] == "2") {
                                                                    echo "<span class='badge badge-success'>FULLY PAID</span>";
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td>No record Found</td>
                                                </tr>
                                                <?php
                                            }

                                            ?>
                                        </tbody>

                                    </table>

                                </div>
                                <?php
                                        }
                                        ?>

                        </div>
                    </div>
                <?php } ?>

            </div>
    </section>
</div>
</body>

</html>


<?php include('includes/footer.php'); ?>
<?php include('includes/script.php'); ?>