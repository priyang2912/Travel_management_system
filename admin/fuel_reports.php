<?php
//session_start();
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
          <h2 class="m-0 text-dark">Fuel Report</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><a>Fuel Reports</a></li>
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
            <form action="#" method="POST"><!--download excel file just type in action="booking_export.php" -->
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">From Date</label>
                    <input type="date" name="from_date" value="<?php if (isset($_POST['from_date'])) {
                      echo $_POST['from_date'];
                    } else {
                    } ?>" class="form-control" placeholder="From Date" required>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">To Date</label>
                    <input type="date" name="to_date" value="<?php if (isset($_POST['to_date'])) {
                      echo $_POST['to_date'];
                    } else {
                    } ?>" class="form-control" placeholder="To Date" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="">Vehicle</label>
                    <select name="vehicle" id="vehicle" class="form-control">
                      <option value="0" selected>All Vehicle</option>
                      <?php
                      $select_v = ("SELECT * FROM vehicle");
                      $query_run = mysqli_query($con, $select_v);

                      while ($row = mysqli_fetch_array($query_run)) {

                        ?>
                        <option value="<?php echo $row['id']; ?>"> <?php echo $row['reg_no']; ?> </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group"></br>
                    <button type="submit" class="btn btn-outline-info" id="check" name="check">Report</button>
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
              <h4 style="color:blue;">Fuel List :-</h4>
              <h5>
                <?php if (isset($_POST['from_date'])) {
                  $fill_dt = date("d M Y", strtotime($_POST['from_date']));
                  echo $fill_dt;
                } else {
                } ?> TO
                <?php if (isset($_POST['to_date'])) {
                  $to_date = date("d M Y", strtotime($_POST['to_date']));
                  echo $to_date;
                } else {
                } ?>
                &nbsp;Vehicle No:
                <?php
                if (isset($_POST['vehicle'])) {
                  $vehicle = $_POST['vehicle'];
                  $select_v = ("SELECT * FROM vehicle WHERE id=$vehicle");
                  $query_run = mysqli_query($con, $select_v);

                  while ($row = mysqli_fetch_array($query_run)) {
                    echo $row['reg_no'];
                  }
                }
                ?>
              </h5>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                    <tr>
                      <th style="text-align:center" hidden>No.</th>
                      <th style="text-align:center">S.No</th>
                      <th style="text-align:center">Vehical No.</th>
                      <th style="text-align:center">Driver</th>
                      <th style="text-align:center">Fill Date</th>
                      <th style="text-align:center">Quantity</th>
                      <th style="text-align:center">Fuel Amount</th>
                      <th style="text-align:center">Km Read</th>
                      <th style="text-align:center">Comment</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['vehicle'])) {


                      if (strtotime($_POST['from_date']) <= strtotime($_POST['to_date'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        if ($_POST['vehicle'] == "0") {
                          $query = "SELECT * FROM fuel WHERE f_filldate BETWEEN '$from_date' AND '$to_date' order by f_filldate ";
                        } else {
                          $sid = $_POST['vehicle'];
                          $query = "SELECT * FROM fuel WHERE id='$sid' AND f_filldate BETWEEN '$from_date' AND '$to_date' order by f_filldate";
                        }
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          $count = 1;
                          foreach ($query_run as $row) {
                            $id = $row['id'];
                            $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                            $res = mysqli_query($con, $sql);
                            $fetch = mysqli_fetch_assoc($res);

                            ?>
                            <tr>
                              <td hidden>
                                <?php echo $row['f_id']; ?>
                              </td>
                              <td>
                                <?php echo $count;
                                $count++; ?>
                              </td>

                              <td>
                                <?php echo $fetch['reg_no']; ?>
                              </td>
                              <td>
                                <?php echo $row['f_driver']; ?>
                              </td>
                              <td>
                                <?php $fill_dt = date("d-m-Y", strtotime($row['f_filldate']));
                                echo $fill_dt; ?>
                              </td>
                              <td>
                                <font color="red">
                                  <?php echo $row['f_quantity']; ?>
                                </font>
                              </td>
                              <td>
                                <font color="green">
                                  <?php echo $row['f_price']; ?>
                                </font>
                              </td>
                              <td>
                                <?php echo $row['f_odm']; ?>
                              </td>
                              <td>
                                <?php echo $row['f_comments']; ?>
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
                <div class="text-center" style="font-size:20px">

                <?php
                $sid = $_POST['vehicle'];
                $resu = mysqli_query($con, "SELECT sum(f_quantity),sum(f_price) FROM fuel WHERE id='$sid' AND f_filldate BETWEEN '$from_date' AND '$to_date' ");
                while ($rows = mysqli_fetch_array($resu)) { ?>
                  <b>Total Diesel Quantity:</b>
                  <?php echo $rows['sum(f_quantity)']+0; ?>&nbsp;&nbsp;
                  <b>Total Amount:</b>
                  <?php echo $rows['sum(f_price)']+0;
                }
                    }
                    ?>
</div>
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