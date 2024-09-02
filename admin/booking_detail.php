<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<html>
  <head>
  <style>
@media print{
  .btn{
    display: none;
  }
}
</style>
<script>
function Getprint(){
  window.print();
}
  </script>
</head>
    <body>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Booking Details
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="booking.php">Booking</a></li>
            <li class="breadcrumb-item active">Add Payment</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">

        <div class="card-body">
          <div class="row">
            
                  <?php 
                   if (isset($_GET['b_id'])) {
                    $id = $_GET['b_id'];
                    $_SESSION['invoice_no']=$id;
                $quer="SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
                  $quer_run=mysqli_query($con,$quer);  
                  if(mysqli_num_rows($quer_run)){
                    while($row=mysqli_fetch_array($quer_run)){
                      $book=$row['b_due_amount'];
                      $adv=$row['b_adv_paid'];
                      $net=$row['b_net_total'];
                    }
                  }?><?php
                  $query="SELECT SUM(pay) FROM booking_payment WHERE b_id='$id' LIMIT 1";
                  $query_run=mysqli_query($con,$query);  
                  if(mysqli_num_rows($quer_run)){
                    while($row=mysqli_fetch_array($query_run)){
                      $pay= $row['SUM(pay)'];
                    }
                  }?><?php
                  if(isset($book,$pay,$adv)){
                    $paid=$adv+$pay;
                    $total=$net-$paid;
                    $_SESSION['b_due_payment']=$total;
                 ?>
                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                          <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Total Amount</span>
                            <span class="info-box-number text-center text-muted mb-0">
                              <?php echo $net; ?>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                          <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Paid Amount</span>
                            <span class="info-box-number text-center text-muted mb-0">
                              <?php echo $paid; ?>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                          <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">Pending</span>
                            <span class="info-box-number text-center text-muted mb-0">
                              <?php echo $total; ?><span>
                              </span>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } } ?>
                    <div class="row">
                    <?php
            if (isset($_SESSION['invoice_no'])) {
             
              $query = "SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                  ?>
                      <div class="col-12">
                        <h4>Overview:</h4>
                        <div class="post">
                          <div class="row">
                            <div class="col-lg-5">
                              <div class="user-block">
                                <span class="username">
                                  <h5><b>
                                      Invoice No:-</b>
                                    <?php echo $row['b_invoice']; ?>
                                  </h5>
                                </span></br>
                                <span class="username">Trip Start:
                                  <?php
                                  $booking_dt = date("d-M-Y", strtotime($row['b_trip_start']));
                                  echo $booking_dt; ?>
                                </span><br>
                                <span class="description">
                                  <p style="font-size:16px"><b>Vehicle Type:</b>
                                    <?php echo $row['b_type']; ?>
                                  </p>
                                </span>
                                <span class="description">
                                  <p style="font-size:16px"><b>KM /Fix price:</b>
                                    <?php echo $row['b_price']; ?>
                                  </p>
                                </span>
                              </div>


                            </div>
                            <div class="col-lg-7">
                              <div class="user-block">
                                <span class="username">
                                  <h5><b>Booking Date:</b>
                                    <?php $book = date("d M Y", strtotime($row['b_book_date']));
                                    echo $book; ?>
                                  </h5>
                                </span><br>
                                <span class="username">Trip End:
                                  <?php
                                  $booking_dt = date("d-M-Y", strtotime($row['b_trip_end']));
                                  echo $booking_dt; ?>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Days:
                                  <?php echo $row['b_total_days']; ?>
                                </span>
                                </br><span class="description">
                                  <p style="font-size:16px"><b>Total Vehicle:</b>
                                    <?php echo $row['b_total']; ?>
                                  </p>
                                </span>
                                <span class="description">
                                  <p style="font-size:16px"><b>Pickup Location:</b>
                                    <?php echo $row['b_pickup']; ?>
                                  </p>
                                </span>
                              </div>
                            </div>
                            <div class="col-lg-4"></div><span class="description">
                              <p style="font-size:16px"><b>Travel Route :</b>
                                <?php echo $row['b_route']; ?>
                              </p>
                              <?php
                }
              } else {
                echo "no record found";
              }
            }
            ?>  </span>     
            </div>
                        </div>
                        

                        <h5>Payment Activity:</h5>
                        <div class="post clearfix">

                          <table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Mode</th>
                                <th>Paid On</th>
                                <th>Comments</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
            if (isset($_SESSION['invoice_no'])) {
             
              $query = "SELECT * FROM booking_payment WHERE b_id='$id'";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                 $count=1;
                foreach ($query_run as $row) {
                  ?>
                              <tr>
                                <td><?php echo $count; $count++;?></td>
                                <td><?php echo $row['pay']; ?></td>
                                <td><?php if($row['mode']=="0"){
                        echo "CASH";
                      }elseif($row['mode']=="1"){
                        echo "ONLINE";
                      } elseif($row['mode']=="2"){
                        echo "CHECK";
                      }elseif($row['mode']=="3"){
                        echo "CARD";
                      }  ?></td>
                                <td> <?php
                      $booking_dt = date("d-m-Y", strtotime($row['s_date']));
                      echo $booking_dt; ?></td>
                                <td><?php echo $row['Note']; ?></td>
                              </tr>
                            </tbody>
                            <?php
                }
              } else {
                echo "no record found";
              }
            }
            ?>

                          </table>

                        </div>
                      </div>

                    </div>
                  </div>
                  <?php
            if (isset($_SESSION['invoice_no'])) {
             
              $query = "SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                  ?>
                  <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <div class="mt-2 mb-3">
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-AddPayment">Add Payment</a>
                    <!--<a href="javascript:window.print()" class="btn btn-sm btn-success" >Generate Invoice</a>-->
                    <button type="button" class="btn btn-sm btn-success" onclick="Getprint()">Generate Invoice</button>
                    </div>
                    <br>
                    <div class="text-muted">
                      <p class="text-sm">Customer Info
                        <b class="d-block">
                          <?php echo $row['b_name']; ?>
                        </b>
                        <b class="d-block">
                          <?php echo $row['b_address']; ?>
                        </b>
                        <b class="d-block">M.
                          <?php echo $row['b_mobile1']; ?>
                        </b>
                        <b class="d-block">M.
                          <?php echo $row['b_mobile2']; ?>
                        </b>
                      </p>
                      <?php
                }
              } else {
                echo "no record found";
              }
            }
            ?>
                     

                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
             

      </div>
    </div>
  </section>
</div>
<div class="modal fade show" id="modal-AddPayment" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Make Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="database.php" method="post">
        <input type="hidden" name="b_id" value="<?php echo $_SESSION['invoice_no']; ?>"/>

          <div class="card-body">
            <div class="form-group row">
              <label for="totalamount" class="col-sm-4 col-form-label">Total Amount</label>
              <div class="col-sm-8">
              <?php
                    
                    $query = " SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                       
                        ?>
                <input type="text" class="form-control" name="totalamount" value="<?php echo $row['b_net_total']; ?>"
                  placeholder="Enter totalamount" disabled>
                  <?php
                      }
                    } else {}
                
                          ?>  
              </div>
            </div>
          <?php  $quer="SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
                  $quer_run=mysqli_query($con,$quer);  
                  if(mysqli_num_rows($quer_run)){
                    while($row=mysqli_fetch_array($quer_run)){
                      $book=$row['b_due_amount'];
                      $adv=$row['b_adv_paid'];
                      $net=$row['b_net_total'];
                    }
                  }?>
            <?php
                  $query="SELECT SUM(pay) FROM booking_payment WHERE b_id='$id' LIMIT 1";
                  $query_run=mysqli_query($con,$query);  
                  if(mysqli_num_rows($quer_run)){
                    while($row=mysqli_fetch_array($query_run)){
                      $pay= $row['SUM(pay)'];
                    }
                  }?><?php
                  if(isset($book,$pay,$adv)){
                    $paid=$adv+$pay;
                    $total=$net-$paid;
                                        $_SESSION['b_due_payment']=$total;
                 ?>
            <div class="form-group row">
              <label for="paidamount" class="col-sm-4 col-form-label">Pending Amount</label>
              <div class="col-sm-8">
                
                <input type="text" class="form-control" name="pendingamount" value="<?php echo $total; ?>" id="pendingamount"
                  placeholder="Paid Amount" disabled>
              
              </div>
             <?php }?>
            </div>
            <div class="form-group row">
              <label for="tp_notes" class="col-sm-4 col-form-label">Vehicle</label>
              <div class="form-group col-sm-8">
                <select name="vehicle" id="vehicle" required="true" class="form-control">
<option value="" selected hidden>Vehicle</option>
<?php $_SESSION['invoice_no'] = $id;
                                    $query = "SELECT * FROM customer_bill_detail WHERE b_id='$id'";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                      foreach ($query_run as $row) {
                                      $v_id = $row['vehicle_type'];
                        $sql = "SELECT * FROM vehicle WHERE id='$v_id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                                        
                                            ?>
                       <option value="<?php echo $fetch['id']; ?>"> <?php echo $fetch['reg_no'];?> </option>

                                            <?php  }
                                    } else {
                                        echo "no record found";
                                    }
                                ?>

                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="tp_amount" class="col-sm-4 col-form-label">Pay</label>
              <div class="form-group col-sm-8">
                <input type="text" class="form-control" name="tp_amount" id="tp_amount" placeholder="Pay">
              </div>
            </div>
            <div class="form-group row">
              <label for="tp_notes" class="col-sm-4 col-form-label">Payment Mode</label>
              <div class="form-group col-sm-8">
                <select name="payment_model" id="payment_mode" required="true" class="form-control">
<option value="" selected hidden>Mode</option>
<option value="0">Cash</option>
<option value="1">Online</option>
<option value="2">Check</option>
<option value="3">Card</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="tp_notes" class="col-sm-4 col-form-label">Notes</label>
              <div class="form-group col-sm-8">
                <textarea class="form-control" id="tp_notes" name="tp_notes" rows="2"
                  placeholder="Enter Notes"></textarea>
              </div>
            </div>
           
          </div>
         
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="booking_payment" class="btn btn-primary">Save Payment</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
                 
</body>
                  </html>

<?php include('includes/script.php'); ?>


<!--<table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Vehicle</th>
                                <th>Total Km</th>
                                <th>Toll Tax</th>
                                <th>Permission</th>
                                <th>Tax</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
            <?php
            
              $query = "SELECT * FROM customer_bill_detail WHERE b_id='$id'";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                $count=1;
                foreach ($query_run as $row) {
                  $id = $row['vehicle_type'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                  ?>
                  <tr>
                                <td><?php echo $count; $count++;?></td>
                                <td><?php echo $fetch['reg_no']; ?></td>
                                <td><?php echo $row['total_odm'];  ?></td>
                                <td> <?php echo $row['toll_tax']; ?></td>
                                <td><?php echo $row['permission']; ?></td>
                                <td><?php echo $row['tax_charge']; ?></td>
                                <td><?php echo $row['total_amount']; ?></td>
                              </tr>
                              <?php
                }
              } else {
                echo "no record found";
              }
            
            ?>
                            </tbody>
                   
                </table>-->      