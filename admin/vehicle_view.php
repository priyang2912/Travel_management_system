<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');

?>

<div class="content-wrapper">



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
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $query = "SELECT * FROM vehicle WHERE id='$id' LIMIT 1";
              $query_run = mysqli_query($con, $query);

              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $row) {
                  ?>



                  <input type="text" name="id" value="<?php echo $row['id'] ?> " hidden>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Registration No *</label>
                        <input type="text" name="reg_no" value="<?php echo $row['reg_no']; ?>" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Vehicle Type *</label>
                        <input type="text" name="type" value="<?php echo $row['seat']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Chassis No *</label>
                        <input type="text" name="cha_no" value="<?php echo $row['cha_no']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Engine No *</label>
                        <input type="text" name="eng_no" value="<?php echo $row['eng_no']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Registration Date *</label>
                        <input type="date" name="reg_dt" value="<?php echo $row['reg_dt']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Permit Expire Date *</label>
                        <input type="date" name="per_dt" value="<?php echo $row['per_dt']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Fitness Expire Date *</label>
                        <input type="date" name="fit_dt" value="<?php echo $row['fit_dt']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Insurance Expire Date *</label>
                        <input type="date" name="ins_dt" value="<?php echo $row['ins_dt']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Puc Expire Date *</label>
                        <input type="date" name="puc_dt" value="<?php echo $row['puc_dt']; ?>" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>RC Document </lable>
                          <input type="hidden" name="old_rc_doc" value="<?php echo $row['rc_doc']; ?>">
                          <input type="file" name="rc_doc" id="rc_doc" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Fitness Document </lable>
                          <input type="hidden" name="old_fit_doc" value="<?php echo $row['fit_doc']; ?>">
                          <input type="file" name="fit_doc" id="fit_doc" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Permit Document </lable>
                          <input type="hidden" name="old_per_doc" value="<?php echo $row['per_doc']; ?>">
                          <input type="file" name="per_doc" id="per_doc" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Insurance Document </lable>
                          <input type="hidden" name="old_ins_doc" value="<?php echo $row['ins_doc']; ?>">
                          <input type="file" name="ins_doc" id="ins_doc" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>PUC Document </lable>
                          <input type="hidden" name="old_puc_doc" value="<?php echo $row['puc_doc']; ?>">
                          <input type="file" name="puc_doc" id="puc_doc" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Vehicle Status</label>
                                            <select id="v_status" name="v_status" class="form-control" required="true">
                                                <option value="" hidden>Select Status</option>
                                                <option value="1" <?php if ($row["v_status"] == '1') {
            echo "selected";}?>>Active</option>
                                                <option value="0" <?php if ($row["v_status"] == '0') {
            echo "selected";}?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                  </div>

                  <?php
                }
              } else {
                echo "no record found";
              }
            }
            ?>


            <div class="modal-footer">
              <button type="button" name="close" class="btn btn-secondary" data-dismiss="modal"> Close</button>
              <button type="submit" name="vehicle_update_btn" class="btn btn-primary">Save</button>

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
          <h1 class="m-0 text-dark">Vehicle Details
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Vehicle Details</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <section class="content">
    <div class="container-fluid">
      <?php

      if (isset($_SESSION['status'])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Vehicle</strong>
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
          <strong>Vehicle</strong>
          <?php echo $_SESSION['w_status']; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        unset($_SESSION['w_status']);

      }

      ?>
      <div class="row">

        <div class="col-md-3">

          <?php
          if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM vehicle WHERE id='$id' LIMIT 1";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
              foreach ($query_run as $row) {
                ?>

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">

                    </div>

                    <h3 class="profile-username text-center">
                      <?php echo $row['reg_no'] ?>
                    </h3>

                    <p class="text-muted text-center">
                      <?php echo $row['seat'] ?>
                    </p>

                    <p class="text-muted text-center"><?php 
                      if($row['v_status']=="1"){
                        echo "<span class='badge badge-success'>Active</span>";
                      }elseif($row['v_status']=="0"){
                        echo "<span class='badge badge-danger'>Inactive</span>";
                      } ?> </p>
                        
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Trips</b> <a class="float-right"><?php
                    $resu = mysqli_query($con, "SELECT count(vehicle_type) FROM customer_bill_detail WHERE vehicle_type=$id");
                    while ($rows = mysqli_fetch_array($resu)) { ?>
                <?php echo $rows['count(vehicle_type)']; }?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Parts Expense</b> <a class="float-right"><?php
                    $resu = mysqli_query($con, "SELECT sum(p_total_amount) FROM part WHERE vehicle_id=$id");
                    while ($rows = mysqli_fetch_array($resu)) { ?>
                <?php echo $rows['sum(p_total_amount)']; }?>
                        </a>
                      </li>
                      <li class="list-group-item">
                        <b>Fuel Quntity</b> <a class="float-right"><?php
                    $resu = mysqli_query($con, "SELECT sum(f_quantity) FROM fuel WHERE id=$id AND MONTH(f_filldate)=MONTH(now())");
                    while ($rows = mysqli_fetch_array($resu)) { ?>
                <?php echo $rows['sum(f_quantity)']; }?>L</a>
                      </li>
                    </ul>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->


              </div>
              <!-- /.col -->

              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#basicinfo" data-toggle="tab">Basic Info</a></li>
                      <li class="nav-item"><a class="nav-link " href="#bookings" data-toggle="tab">Trips</a></li>
                      <li class="nav-item"><a class="nav-link" href="#vechicle_incomexpense" data-toggle="tab">Income &
                          Expense</a></li>
                      <li class="nav-item"><a class="nav-link" href="#vechicle_fuel" data-toggle="tab">Fuel</a></li>
                      <li class="nav-item"><a class="nav-link" href="#vechicle_part" data-toggle="tab">Part</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="basicinfo">
                        <table class="table table-sm table-bordered">
                          <tbody>

                            <tr>
                              <td style="width:50%">Registration No</td>
                              <td>
                                <?php echo $row['reg_no'] ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Vehicle Type</td>
                              <td>
                                <?php echo $row['seat'] ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Chassis No.</td>
                              <td>
                                <?php echo $row['cha_no'] ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Engine No.</td>
                              <td>
                                <?php echo $row['eng_no'] ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Registration Date</td>
                              <td>
                                <?php
                                $reg_dt = date("d-m-Y", strtotime($row['reg_dt']));
                                echo $reg_dt; ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Permit Expire Date</td>
                              <td>
                                <?php
                                $booking_dt = date("d-m-Y", strtotime($row['per_dt']));
                                echo $booking_dt; ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Fitness Expire Date</td>
                              <td>
                                <?php
                                $fit_dt = date("d-m-Y", strtotime($row['fit_dt']));
                                echo $fit_dt; ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Insurance Expire Date</td>
                              <td>
                                <?php
                                $ins_dt = date("d-m-Y", strtotime($row['ins_dt']));
                                echo $ins_dt; ?>
                              </td>
                            </tr>
                            <tr>
                              <td>Puc Expire Date</td>
                              <td>
                                <?php
                                $puc_dt = date("d-m-Y", strtotime($row['puc_dt']));
                                echo $puc_dt; ?>
                              </td>
                            </tr>
                            <tr>
                              <td>RC Doc</td>
                              <td><a href="./vehicle_doc/<?php echo $row['rc_doc']; ?>" download>Download</a></td>
                            </tr>
                            <tr>
                              <td>Fitness Document</td>
                              <td><a href="./vehicle_doc/<?php echo $row['fit_doc']; ?>" download>Download</a></td>
                            </tr>
                            <tr>
                              <td>Permit Document</td>
                              <td><a href="./vehicle_doc/<?php echo $row['per_doc']; ?>" download>Download</a></td>
                            </tr>
                            <tr>
                              <td>Insurance Document</td>
                              <td><a href="./vehicle_doc/<?php echo $row['ins_doc']; ?>" download>Download</a></td>
                            </tr>
                            <tr>
                              <td>PUC Document</td>
                              <td><a href="./vehicle_doc/<?php echo $row['puc_doc']; ?>" download>Download</a></td>
                            </tr>


                          </tbody>
                        </table>


                        <a href="#" data-toggle="modal" data-target="#addform" class="btn btn-success float-right">Edit
                          Info</a>


                      </div>
                      <!-- /.tab-pane -->
                      <!-- <div class="tab-content"> -->
                      <div class="tab-pane" id="bookings">
                  <table id="example1" class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Start Odm</th>
                                    <th>End Odm</th>
                                    <th>Total Odm</th>
                                    <th>Rate</th>
                                    <th>Toll Tax</th>
                                    <th>Da</th>
                                    <th>Permisssion</th>
                                    <th>Tax Charge</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  $id = $_GET['id'];
                    $query = " SELECT * FROM customer_bill_detail WHERE vehicle_type='$id'";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                        $id = $row['b_id'];
                        
                        ?>
                            
                               
                  <tr >
                    <td hidden>
                        <?php echo $row['b_id']; ?>
                      </td>
                      <td><?php echo $count; $count++;?></td>

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

                                        <!-- <div class="tab-content"> -->
                                        <div class="tab-pane" id="vechicle_incomexpense">
                  <table id="dtBasicExampleI" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                  $id = $_GET['id'];
                    $query = " SELECT * FROM income_expence WHERE v_id='$id'";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];                        
                        ?>
                            
                               
                  <tr >
                    <td hidden>
                        <?php echo $row['i_id']; ?>
                      </td>
                      <td><?php echo $count; $count++;?></td>

                    <td>
                    <?php
                    $booking_dt = date("d-m-Y", strtotime($row['i_date']));
                    echo $booking_dt; ?>
                    </td>
                    <td>
                    <?php echo $row['i_amount']; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['i_type']=="0"){
                        echo "<span class='badge badge-success'>Income</span>";
                      }elseif($row['i_type']=="1"){
                        echo "<span class='badge badge-danger'>Expence</span>";
                      } ?>
                    </td>
                    <td>
                      <?php echo $row['i_description']; ?>
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


                      <div class="tab-pane" id="vechicle_fuel">
                      <table id="dtBasicExampleF" class="table table-striped table-bordered" cellspacing="1" width="100%">
                          <thead>
                            <tr>
                            <th hidden>Id</th>
                              <th>S.No</th>
                              <th>Driver</th>
                              <th>Fill Date</th>
                              <th>Quantity</th>
                              <th>Odometer</th>
                              <th>Fuel Price</th>
                              <th>Comments</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
              $id = $_GET['id'];

                            $query = " SELECT * FROM fuel WHERE id='$id'";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                              $count=1;
                              foreach ($query_run as $row) {
                                //echo $row['name'];
                                ?>


                                <tr>
                                  <td hidden>
                                    <?php echo $row['f_id']; ?>
                                  </td>
                                  <td><?php echo $count; $count++;?></td>

                                  <td>
                                    <?php echo $row['f_driver']; ?>
                                  </td>
                                  <td>
                                    <?php
                                    $booking_dt = date("d-m-Y", strtotime($row['f_filldate']));
                                    echo $booking_dt; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['f_quantity']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['f_odm']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['f_price']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['f_comments']; ?>
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
                      
                      <!-- /.tab-pane -->
                      <!--<div class="tab-content"> -->

                      <div class="tab-pane" id="vechicle_part">
                     
                      <table id="dtBasicExampleP" class="table table-striped table-bordered" cellspacing="1" width="100%">
                          <thead>
                            <tr>
                            <th hidden>Id</th>
                              <th>S.No</th>
                              <th>Buy Date</th>
                              <th>Parts Info</th>
                              <th>Quantity</th>
                              <th>Vendor</th>
                              <th>Total Price</th>
                              <th>Odometer</th>
                              <th>Warranty</th>
                        
                            </tr>
                          </thead>
                          <tbody>
                            <?php
              $id = $_GET['id'];
                            $query = " SELECT * FROM part WHERE vehicle_id='$id'";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                              $count=1;
                              foreach ($query_run as $row) {
                                //echo $row['name'];
                                ?>


                                <tr>
                                  <td hidden>
                                    <?php echo $row['p_id']; ?>
                                  </td>
                                  <td><?php echo $count; $count++;?></td>

                                  <td>
                                    <?php
                                    $booking_dt = date("d-m-Y", strtotime($row['p_buy_date']));
                                    echo $booking_dt; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['p_part']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['p_quantity']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['p_vendor']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['p_total_amount']; ?>
                                  </td>
                                  <td>
                                    <?php echo $row['p_odm']; ?>
                                  </td>
                                  <td>
                                    <?php
                                    $booking_dt = date("d-m-Y", strtotime($row['p_warranty_dt']));
                                    echo $booking_dt; ?>
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
                    <!-- /.tab-content -->
                    <?php
              }
            } else {
              echo "no record found";
            }


          }
          ?>
                      <!-- /.tab-pane -->

                      </div>
                    
              <!-- /.tab-content -->
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

<script>
$(document).ready(function () {
  $('#dtBasicExampleF').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$(document).ready(function () {
  $('#dtBasicExampleP').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
$(document).ready(function () {
  $('#dtBasicExampleI').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
  </script>
