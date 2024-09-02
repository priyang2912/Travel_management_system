<?php
include('authentication.php');
include('includes/header.php');
include('includes/sidebar.php');
include('includes/topbar.php');
include('config/dbcon.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php

  if (isset($_SESSION['status'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Hey!
        <?php
        if (isset($_SESSION['auth'])) {
          echo $_SESSION['auth_user']['user_name'];
        } ?>
      </strong>
      <?php echo $_SESSION['status']; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
    unset($_SESSION['status']);

  }

  ?>
  <?php

  if (isset($_SESSION['w_status'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Login</strong>
      <?php echo $_SESSION['w_status']; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
    unset($_SESSION['w_status']);

  }

  ?>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $query = "SELECT * FROM vehicle";
              $query_run = mysqli_query($con, $query);
              if ($rentform = mysqli_num_rows($query_run)) {
                echo '<h3>' . $rentform . '</h3>';
              } else {
                echo '<h3>No Data</h3>';
              }
              ?>
              <p>Total Vehicles</p>
            </div>
            <div class="icon">
              <i class="fas fa-shuttle-van"></i>
            </div>
            <a href="vehicle.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $query = "SELECT * FROM booking";
              $query_run = mysqli_query($con, $query);
              if ($booking = mysqli_num_rows($query_run)) {
                echo '<h3>' . $booking . '</h3>';
              } else {
                echo '<h3>No Data</h3>';
              }
              ?>
              <p>Total Bookings</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-alt"></i>
            </div>
            <a href="booking.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $query = "SELECT * FROM customer_bill_detail";
              $query_run = mysqli_query($con, $query);
              if ($trip = mysqli_num_rows($query_run)) {
                echo '<h3>' . $trip . '</h3>';
              } else {
                echo '<h3>No Data</h3>';
              }
              ?>
              <p>Total Trips</p>
            </div>
            <div class="icon">
              <i class="fas fa-route"></i>
            </div>
            <a href="booking.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
              $query = "SELECT * FROM driver";
              $query_run = mysqli_query($con, $query);
              if ($driver = mysqli_num_rows($query_run)) {
                echo '<h3>' . $driver . '</h3>';
              } else {
                echo '<h3>No Data</h3>';
              }
              ?>
              <p>Total Drivers</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-secret"></i>
            </div>
            <a href="driver.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-6">
          <div class="card">
          <div class="card-header border-transparent">
                <h3 class="card-title">Current Month Total Bookings:</h3> 
                <h5 class="card-title"> &nbsp; <font color="blue"><?php $query =mysqli_query($con, ("SELECT COUNT(*) FROM `booking` WHERE MONTH(b_trip_start)=MONTH(now())")); 
                                    $query_run = mysqli_fetch_array($query);
                echo $query_run['COUNT(*)'];
                ?></font></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Invoice No.</th>
                      <th>Trip Date</th>
                      <th>Days</th>
                      <th>Route</th>
                      <th>Type</th>
                      <th>Price</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT b_invoice,b_trip_start,b_total_days,b_route,b_type,b_price,b_status FROM `booking` WHERE MONTH(b_trip_start)=MONTH(now())";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                    ?>
                  <tr>
                    <td>
                      <?php echo $row['b_invoice']; ?>
                    </td>
                    <td>
                      <?php 
                      $travel_dt = date("d-m", strtotime($row['b_trip_start']));
                      echo $travel_dt;
                       ?>
                    </td>
                    <td>
                      <?php echo $row['b_total_days']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_route']; ?>
                    </td>
                    <td>
                      <?php echo $row['b_type']; ?>
                    </td>
                    <td><font color="green">
                    &#8377;<?php echo $row['b_price']; ?>
                    </td></font>
                    <td >
                      <?php 
                      if($row['b_status']=="1"){
                        echo "<span class='badge badge-warning'>Partially Paid</span>";
                      }elseif($row['b_status']=="2"){
                        echo "<span class='badge badge-success'>Fully Paid</span>";
                      }elseif($row['b_status']=="0"){
                        echo "<span class='badge badge-danger'>Unpaid</span>";
                      } ?>

                    </td>       
                    </tr>
                  <?php
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
                  </div>
                  
                  <div class="card-footer clearfix">
                
                <a href="booking.php" class="btn btn-sm btn-secondary float-right">View All Booking</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>

          <div class="col-lg-6">
          <div class="card">
          <div class="card-header border-transparent">
                <h3 class="card-title">Vehicle Document Expire List:</h3> 
                <h5 class="card-title"> &nbsp; <font color="blue"><?php $query =mysqli_query($con, "SELECT COUNT(*) FROM `vehicle` WHERE (per_dt <= CURRENT_DATE() OR puc_dt <= CURRENT_DATE() OR fit_dt <= CURRENT_DATE() OR ins_dt <= CURRENT_DATE() )"); 
                                    $query_run = mysqli_fetch_array($query);
                echo $query_run['COUNT(*)'];
                ?></font></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Vehicle</th>
                      <th>Permit</th>
                      <th>Fitness</th>
                      <th>Insurance</th>
                      <th>Puc</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT reg_no,per_dt,fit_dt,ins_dt,puc_dt FROM `vehicle` WHERE (per_dt <= CURRENT_DATE() OR puc_dt <= CURRENT_DATE() OR fit_dt <= CURRENT_DATE() OR ins_dt <= CURRENT_DATE() )";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                    ?>
                  <tr>
                  <td><?php echo $count; $count++;?></td>

                    <td>
                      <?php echo $row['reg_no']; ?>
                    </td>
                    <td>
                      <?php   
                      $per_dt = date("d-m-Y", strtotime($row['per_dt']));
                      echo $per_dt;?>
                    
                    </td>
                    <td>
                      <?php 
                      $fit_dt = date("d-m-Y", strtotime($row['fit_dt']));
                      echo $fit_dt;
                       ?>
                    </td>
                    <td>
                      <?php 
                      $ins_dt = date("d-m-Y", strtotime($row['ins_dt']));
                      echo $ins_dt;
                       ?>
                    </td>
                    <td>
                      <?php 
                      $puc_dt = date("d-m-Y", strtotime($row['puc_dt']));
                      echo $puc_dt;
                       ?>
                    </td>
                    </tr>
                  <?php
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
                  </div>
                  
                  <div class="card-footer clearfix">
                
                <a href="vehicle.php" class="btn btn-sm btn-secondary float-right">View All Vehicle</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          </div>
<div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-history"></i></span>

              <div class="info-box-content">
                
                <div class="info-box-content">
                <?php
                $query = mysqli_query($con,"SELECT sum(p_due_amount) FROM `part` WHERE p_status='1'");
                $result = mysqli_fetch_array($query);
                $total_expence = $result['sum(p_due_amount)'];
                ?>
                <span class="info-box-text">Parts Total Due Amount</span>
                <span class="info-box-number">&#8377;&nbsp;<?php echo $total_expence; ?></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-hourglass-half"></i></span>

              <div class="info-box-content">
                
                <div class="info-box-content">
                <?php
                $query = mysqli_query($con,"SELECT sum(m_due_payment) FROM `maintanance` WHERE m_status='1'");
                $result = mysqli_fetch_array($query);
                $total_expence = $result['sum(m_due_payment)'];
                ?>
                <span class="info-box-text">Maintanance Due Amount</span>
                <span class="info-box-number">&#8377;&nbsp;<?php echo $total_expence; ?></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
                  </div>
                  <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-chart-line"></i></span>

              <div class="info-box-content">
                
                <div class="info-box-content">
                <?php
                $query = mysqli_query($con,"SELECT sum(i_amount) FROM `income_expence` WHERE i_type='0' AND YEAR(i_date)=YEAR(now())");
                $result = mysqli_fetch_array($query);
                $total_income = $result['sum(i_amount)'];
                ?>
                <span class="info-box-text">Yearly Income</span>
                <span class="info-box-number">&#8377;&nbsp;<?php echo $total_income; ?></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
                  </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                
                <div class="info-box-content">
                <?php
                $query = mysqli_query($con,"SELECT sum(i_amount) FROM `income_expence` WHERE i_type='1' AND YEAR(i_date)=YEAR(now())");
                $result = mysqli_fetch_array($query);
                $total_expence = $result['sum(i_amount)'];
                ?>
                <span class="info-box-text">Yearly Expenses</span>
                <span class="info-box-number">&#8377;&nbsp;<?php echo $total_expence; ?></span>

              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
                  </div>
                  </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
</div>




<?php include('includes/script.php'); ?>


<?php
include('includes/footer.php');
?>