<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<div class="content-wrapper">
  <!-- Delete Modal start -->
<div class="modal fade" id="deleteBillModal" tabindex="-1" role="dialog" aria-labelledby="deleteFuelModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBillModalLabel">Bill data Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="billv_delete_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->

 <!-- Modal -->
 <div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vehicle Edit Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="database.php" method="POST">
          <div class="modal-body">
          <?php
        if(isset($_GET['b_id']))
        {
            $id=$_GET['b_id'];
            $query="SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    ?>
                

   
    <input type="text" name="b_id" value="<?php echo $row['b_id'] ?> " readonly>
    <div class="row">
    <div class="col-sm-6 col-md-3">
                  <label class="form-label">Invoice No.<span class="form-required">*</span></label>
                  <div class="form-group">
                     <input type="number" name="b_invoice" maxlength="4" value="<?php echo $row['b_invoice']; ?>" class="form-control" placeholder="Enter Invoice No" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Booking Date<span class="form-required">*</span></label>
                     <input type="date" name="b_book_date" value="<?php echo $row['b_book_date']; ?>" class="form-control" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Name<span class="form-required">*</span></label>
                     <input type="text" name="b_name" maxlength="20" value="<?php echo $row['b_name']; ?>" class="form-control" placeholder="Enter Name" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Address<span class="form-required">*</span></label>
                     <input type="text" class="form-control"  value="<?php echo $row['b_address']; ?>" placeholder="Address" maxlength="60"  name="b_address">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Mobile No<span class="form-required">*</span></label>
                     <input type="tel" name="b_mobile1" maxlength="10" class="form-control" value="<?php echo $row['b_mobile1']; ?>" placeholder="Enter Mobile No." form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Mobile No.</label>
                     <input type="tel" name="b_mobile2" maxlength="10" class="form-control" value="<?php echo $row['b_mobile2']; ?>" placeholder="Enter Mobile No." >
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Pickup Location<span class="form-required">*</span></label>
                     <input type="text" name="b_pickup" maxlength="40" class="form-control" value="<?php echo $row['b_pickup']; ?>" placeholder="Enter Pickup Location" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Trip Date & Time<span class="form-required">*</span></label>
                     <input type="datetime-local" name="b_trip_start" class="form-control" value="<?php echo $row['b_trip_start']; ?>" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">End Trip Date & Time<span class="form-required">*</span></label>
                     <input type="datetime-local" name="b_trip_end" class="form-control" value="<?php echo $row['b_trip_end']; ?>" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Total Days<span class="form-required">*</span></label>
                     <input type="text" maxlength="2" max="31" pattern="[0-9]+" name="b_total_days" value="<?php echo $row['b_total_days']; ?>" class="form-control" placeholder="Enter Total Days " form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Total Members<span class="form-required">*</span></label>
                     <input type="text" maxlength="2" name="b_member" pattern="[0-9]+" class="form-control" value="<?php echo $row['b_member']; ?>" placeholder="Enter Total Member" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Bus / Car Type<span class="form-required">*</span></label>
                     <input type="text" maxlength="50" name="b_type" class="form-control" value="<?php echo $row['b_type']; ?>" placeholder="Enter Vehicle Type" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                 <div class="form-group">
                     <label class="form-label">Total Bus/car</label>
                     <select name="b_total" required="true" class="form-control" value="<?php echo $row['b_total']; ?>">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="10">11</option>
                      <option value="10">12</option>
                      <option value="10">13</option>
                      <option value="10">14</option>
                      <option value="10">15</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Route<span class="form-required">*</span></label>
                     <input type="text" maxlength="30" name="b_route" value="<?php echo $row['b_route']; ?>" class="form-control" placeholder="Enter Route details" form-required>
                  </div>
               </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">KM Price/ Fix Rate<span class="form-required">*</span></label>
                     <input type="text" maxlength="14" name="b_price" class="form-control" value="<?php echo $row['b_price']; ?>" pattern="^[0-9]+\.?[0-9]{0,2}$" placeholder="Enter KM / Fix price" form-required>
                  </div>
               </div>
               
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Reference</label>
                     <input type="text" maxlength="16" name="b_reference" value="<?php echo $row['b_reference']; ?>" class="form-control" placeholder="Enter Reference Name">
                  </div>
               </div>
               <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                     <label class="form-label">Deposite<span class="form-required">*</span></label>
                     <input type="text" maxlength="14" name="b_deposite" value="<?php echo $row['b_deposite']; ?>" class="form-control" pattern="^[0-9]+\.?[0-9]{0,2}$" placeholder="Enter Deposite" form-required>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                     <label class="form-label">Note/ Any Information</label>
                     <input type="text" maxlength="28" name="b_note" value="<?php echo $row['b_note']; ?>" class="form-control" placeholder="Enter Note">
                  </div>
               </div>
               <div class="col-sm-6 col-md-6">
                  <div class="form-group">
                     <label class="form-label">Payment Status</label>
                     <select name="b_status" class="form-control">
                        <option value="" selected hidden>Status</option>
                        <option value="0" <?php if ($row["b_status"] == '0') {
            echo "selected";}?>>UNPAID</option>
                        <option value="1" <?php if ($row["b_status"] == '1') {
            echo "selected";}?>>PARTIALLY PAID</option>
                        <option value="2" <?php if ($row["b_status"] == '2') {
            echo "selected";}?>>FULLY PAID</option> 
                     </select>
                  </div>
               </div>
                        </div>

    <?php
                }
            }
            else{
                echo "no record found";
            }
        }
        ?>


    <div class="modal-footer">
              <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal"> Close</button>
              <button type="submit" name="booking_update_btn" class="btn btn-primary">Save</button>
            
</div>
                </div>
                </form>
                </div>
                </div>
                </div>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Booking Details
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    


    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <?php

if (isset($_SESSION['status'])) {
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Booking Update</strong>
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
    <strong>Booking </strong>
    <?php echo $_SESSION['w_status']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
  unset($_SESSION['w_status']);

}

?>
          <div class="col-md-9">
          <?php
        if(isset($_GET['b_id']))
        {
            $id=$_GET['b_id'];
            $query="SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    ?>
          </div>
          <!-- /.col -->

          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                   <li class="nav-item"><a class="nav-link active" href="#basicinfo" data-toggle="tab">Booking Info</a></li>
                  <li class="nav-item"><a class="nav-link " href="#billinfo" data-toggle="tab">Bill Info</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <div class="tab-pane active" id="basicinfo">
                    <table class="table table-sm table-bordered">
                  <tbody>
                 
                    <tr>
                      <td style="width:50%"><b>Invoice No</b></td>
                      <td><?php echo $row['b_invoice']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Booking Date</b></td>
                      <td><?php $booking_dt = date("d-M-Y D", strtotime($row['b_book_date']));
                      echo $booking_dt; ?></td>
                    </tr>
                                        <tr>
                      <td><b>Name</b></td>
                      <td><?php echo $row['b_name']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Address</b></td>
                      <td><?php echo $row['b_address']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Mobile1</b></td>
                      <td> <?php echo $row['b_mobile1']; ?></td>
                    </tr>
                     <tr>
                      <td><b>Mobile2</b></td>
                      <td> <?php echo $row['b_mobile2']; ?></td>
                    </tr>
                     <tr>
                      <td><b>Pickup Address</b></td>
                      <td> <?php echo $row['b_pickup']; ?></td>
                    </tr>
                     <tr>
                      <td><b>Trip Start Date</b></td>
                      <td> <?php
                      $ins_dt = date("d-M-Y D h:i A", strtotime($row['b_trip_start']));
                      echo $ins_dt; ?></td>
                    </tr>
                     <tr>
                      <td><b>Trip End Date</b></td>
                      <td> <?php $end=date("d-M-Y D h:i A", strtotime($row['b_trip_end'])); 
                      echo $end;
                      ?></td>
                    </tr>
                     <tr>
                      <td><b>Total Days</b></td>
                      <td><?php echo $row['b_total_days']; ?></td>
                    </tr>
                     <tr>
                      <td><b>Total Members</b></td>
                      <td><?php echo $row['b_member']; ?></td>       
                     </tr>
                     <tr>
                      <td><b>Bus/Car Type</b></td>
                      <td><?php echo $row['b_type']; ?></td>       
                    </tr>
                     <tr>
                      <td><b>Total Bus/Car</b></td>
                      <td><?php echo $row['b_total']; ?></td>       
                    </tr>
                    <tr>
                      <td><b>Price</b></td>
                      <td><?php echo $row['b_price']; ?></td>       
                    </tr>
                    <tr>
                      <td><b>Route</b></td>
                      <td><?php echo $row['b_route']; ?></td>       
                    </tr>
                    <tr>
                      <td><b>Reference</b></td>
                      <td><?php echo $row['b_reference']; ?></td>       
                    </tr>
                    <tr>
                      <td><b>Deposite</b></td>
                      <td><?php echo $row['b_deposite']; ?></td>       
                    </tr>
                    <tr>
                      <td><b>Note</b></td>
                      <td><?php echo $row['b_note']; ?></td>       
                    </tr>
                   
                 
                  </tbody>
                </table>

                
                  <a href="#" data-toggle="modal" data-target="#addform" class="btn btn-success float-right">Edit Info</a>
                 
                
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="billinfo">
                  <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>Id.</th>
                                    <th>Vehicle No</th>
                                    <th>Start Odm</th>
                                    <th>End Odm</th>
                                    <th>Total Odm</th>
                                    <th>Rate</th>
                                    <th>Toll Tax</th>
                                    <th>Da</th>
                                    <th>Permisssion</th>
                                    <th>Tax Charge</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM customer_bill_detail WHERE b_id='$id'";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                        $id = $row['b_id'];
                        $vehicle=$row['vehicle_type'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$vehicle'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                        ?>
                            
                               
                  <tr >
                  <td class="id" hidden>
                        <?php echo $row['id'];?>
                      </td>
                    <td>
                        <?php echo $row['b_id']; ?>
                      </td>
                    
                    <td>
                      
                    <?php echo $fetch['reg_no']; ?>
                    </td>
                    <td>
                      <?php echo $row['start_odm']; ?>
                    </td>
                    <td>
                    <?php echo $row['end_odm']; ?>
                    </td>
                    <td>
                      <?php echo $row['total_odm']; ?>
                    </td>
                    <td>
                      <?php echo $row['rate']; ?>
                    </td>
                    <td>
                      <?php echo $row['toll_tax']; ?>
                    </td>
                    <td>
                      <?php echo $row['da']; ?>
                    </td>
                    <td>
                      <?php echo $row['permission']; ?>
                    </td>
                    <td>
                      <?php echo $row['tax_charge']; ?>
                    </td>
                    <td>
                      <?php echo $row['total_amount']; ?>
                    </td>
                    <td>
                    <a href="#" class="badge badge-danger bill_delete_btn"><i class="fa fa-trash-alt"></i></a>
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
                        </table><br>
                      <table><tbody><?php $query="SELECT * FROM booking WHERE b_id='$id' LIMIT 1";
            $query_run = mysqli_query($con,$query);

            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $row)
                {
                    ?><tr><td><b>Sub Total:&nbsp;&nbsp;</b><?php echo $row['b_sub_total']; ?></td><td>&nbsp;&nbsp;<b>Discount:</b>&nbsp;<?php echo $row['b_discount']; ?></td><td><b>&nbsp;&nbsp;Net Total:</b>&nbsp;<?php echo $row['b_net_total']; ?></td><td>&nbsp;&nbsp;<b>Advance Paid:</b>&nbsp;<?php echo $row['b_adv_paid']; ?></td></tr></tbody><?php } }else{echo "no record Found";}?></table>
                </div>
                <!-- /.tab-content -->
                <?php
                }
            }
            else{
                echo "no record found";
            }
        }
        ?>
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->



          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('includes/script.php'); ?>

<?php
include('includes/footer.php');
?>
<script type ="text/javascript">
  $(document).ready(function () {

    $(document).on ("click",".bill_delete_btn",function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.id').text();
      //console.log(id);
      $('#id').val(id);
      $('#deleteBillModal').modal('show');
    });
  });
</script>