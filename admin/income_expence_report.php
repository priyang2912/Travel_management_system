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
          <h2 class="m-0 text-dark">Income & Expense Report</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><a>Income & Expense Report</a></li>
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
                  <div class="form-group">
                    <label for="">Check</label></br>
                    <button type="submit" class="btn btn-primary" id="check" name="check">Submit</button>
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

              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                    <tr>
                      <th style="text-align:center" hidden>No.</th>
                      <th style="text-align:center">S.No</th>
                      <th style="text-align:center">Vehical No.</th>
                      <th style="text-align:center">Type</th>
                      <th style="text-align:center">Date</th>
                      <th style="text-align:center">Amount</th>
                      <th style="text-align:center">Description</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['vehicle'])) {


                      if (strtotime($_POST['from_date']) <= strtotime($_POST['to_date'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        if ($_POST['vehicle'] == "0") {
                          $query = "SELECT * FROM income_expence WHERE i_date BETWEEN '$from_date' AND '$to_date' order by i_date ";
                        } else {
                          $sid = $_POST['vehicle'];
                          $query = "SELECT * FROM income_expence WHERE v_id='$sid' AND i_date BETWEEN '$from_date' AND '$to_date' order by i_date";
                        }
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          $count = 1;
                          foreach ($query_run as $row) {
                            $id = $row['v_id'];
                            $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                            $res = mysqli_query($con, $sql);
                            $fetch = mysqli_fetch_assoc($res);

                            ?>
                            <tr>
                              <td hidden>
                                <?php echo $row['i_id']; ?>
                              </td>
                              <td>
                                <?php echo $count;
                                $count++; ?>
                              </td>

                              <td>
                                <?php echo $fetch['reg_no']; ?>
                              </td>
                              <td>
                                <?php
                                if ($row['i_type'] == "0") {
                                  echo "<span class='badge badge-success'>Income</span>";
                                } elseif ($row['i_type'] == "1") {
                                  echo "<span class='badge badge-danger'>Expence</span>";
                                } ?>
                              </td>
                              <td>
                                <?php $fill_dt = date("d-m-Y", strtotime($row['i_date']));
                                echo $fill_dt; ?>
                              </td>
                              <td>
                                <?php echo $row['i_amount']; ?>
                              </td>
                              <td>
                                <?php echo $row['i_description']; ?>
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
                  $resu = mysqli_query($con, "SELECT sum(i_amount) FROM income_expence WHERE i_type=0 AND v_id='$sid' AND i_date BETWEEN '$from_date' AND '$to_date' ");
                  while ($rows = mysqli_fetch_array($resu)) {

                    $income = $rows['sum(i_amount)'];
                    ?>
                    <b>Income:</b>
                    <?php echo $income + 0;
                  } ?>&nbsp;&nbsp;

                  <?php $sid = $_POST['vehicle'];
                  $resu = mysqli_query($con, "SELECT sum(i_amount) FROM income_expence WHERE i_type=1 AND v_id='$sid' AND i_date BETWEEN '$from_date' AND '$to_date' ");
                  while ($rows = mysqli_fetch_array($resu)) {

                    $expence = $rows['sum(i_amount)'];
                    ?>
                    <b>Expence:</b>
                    <?php echo $expence + 0;
                    $profit = $income - $expence; ?>&nbsp;&nbsp;
                    <b>Profit:</b>
                    <?php echo $profit;
                  }

                    } ?>


                <?php ?>
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