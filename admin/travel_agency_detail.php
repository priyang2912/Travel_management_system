<?php
session_start();
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<!-- Delete Modal start -->
<div class="modal fade" id="deleteAgencyModal" tabindex="-1" role="dialog" aria-labelledby="deleteAgencyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteAgencyModalLabel">Travel Agency Info Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="t_id" id="t_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="travel_agency_del_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->
   <!-- Edit Modal -->
   <div class="modal fade" id="editPartModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPartModalLabel">Part Details Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
          
            <div class="row">
              <input type="hidden" name="p_id" id="edit_p_id" value="" readonly>
              <div class="col-sm-6 col-md-3">
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">
                <select id="edit_vehicle_id" class="form-control selectized" name="vehicle_id" required="true">
                  <option value="" selected hidden>Select Vechicle</option>
                  <?php 
                  $select_v=("SELECT * FROM vehicle");
                  $query_run = mysqli_query($con,$select_v);

                  while($row=mysqli_fetch_array($query_run))
                  {
          ?>
          <option value="<?php echo $row['id'] ?>"> <?php echo $row['reg_no']; ?> </option>
          <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
                            <div class="form-group">
                                <label for="buy_date">Buy Date *</label>
                                <input type="date" name="p_buy_date" id="edit_p_buy_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="p_part">Discription Part*</label>
                                <input type="text" name="p_part" maxlength="100" id="edit_p_part" class="form-control" placeholder="part name" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_quantity">Quantity*</label>
                                <input type="number" name="p_quantity" maxlength="20" max="90" min="1" id="edit_p_quantity" class="form-control" placeholder="1" required>
                            </div>
                        </div>
            
                                  <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_vendor">Store/vendor Name </label>
                                <input type="text" name="p_vendor" id="edit_p_vendor" maxlength="70" class="form-control" placeholder="Vendor Name" />
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_bill_no">Bill No*</label>
                                <input type="text" name="p_bill_no" id="edit_p_bill_no" maxlength="60" class="form-control" placeholder="Bill NO" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Bill</label>
                        <input type="hidden" name="edit_oldbill_doc" id="edit_oldbill_doc">
                        <input type="file" name="p_bill_doc" id="p_bill_doc"  class="form-control" placeholder="Upload Bill" >
                      </div>
                    </div>
            
                                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_warranty_dt">Warranty Expire</label>
                                <input type="date" name="p_warranty_dt" id="edit_p_warranty_dt" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_price">Part Price*</label>
                                <input type="text" name="p_price" id="edit_p_price" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="^[0-9]+\.?[0-9]{0,2}$" required>
                            </div>
                        </div>
                          
                    <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_odm">Odomeater</label>
                                <input type="text" name="p_odm" id="edit_p_odm" maxlength="7" min="1" class="form-control"
                                    placeholder="455678" pattern="[0-9]+">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_total_amount">Total Amount*</label>
                                <input type="text" name="p_total_amount" id="edit_p_total_amount" maxlength="8" class="form-control"
                                    placeholder="10,000.00" pattern="^[0-9]+\.?[0-9]{0,2}$" required>
                            </div>
                        </div>
                        <div class="form-group">
                <label for="">Payment</label></br>
                <select id="edit_p_status" name="p_status" class="form-control" require="true" >
                <option value="none" selected disabled hidden>Select</option>
                  <option value="0">Paid</option>
                  <option value="1">Due Payment</option>
                </select>
              </div>

                        <div class="col-md-2">
                            <div class="form-group" >
                                <label for="p_due_amount">Due Payment</label>
                                <input type="number" name="p_due_amount" id="edit_p_due_amount" maxlength="8" min="0" class="form-control"
                                    placeholder="1000.00" pattern="^[0-9]+\.?[0-9]{0,2}$">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="p_payment_dt">Payment Date</label>
                                <input type="date" name="p_payment_dt" id="edit_p_payment_dt" class="form-control">
                            </div>
                        </div>
                       
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="p_comment">Comment </label>
                                <input type="text" name="p_comment" maxlength="200" class="form-control" id="edit_p_comment" placeholder="any">
                            </div>
                        </div>
          </div>
          <div class="modal-footer">
          <input type="reset" value="Reset" class="btn btn-danger" />
            <button type="submit" class="btn btn-primary" name="part_update_btn">Update Part</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit End Modal -->

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Travel Agent List</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Travel Agent</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
    <?php

if (isset($_SESSION['status'])) {
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Travel Agency</strong>
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
    <strong>Travel Agency</strong>
    <?php echo $_SESSION['w_status']; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?php
  unset($_SESSION['w_status']);

}

?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <form action="database.php" method="POST" autocomplete="off">
                            <div class="row">
                        
                        <div class="col-md-4">
                        <div class="form-group">
                <label for="">TRAVEL AGENCY NAME *</label>
                <input type="text" name="agency_name" class="form-control" placeholder="TRAVEL COMPANY NAME" required>
              </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                <label for="">OWNER FULL NAME *</label>
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
              </div>
                        </div>
                        <div class="col-md-2">
                        <div class="form-group">
                <label for="">Mobile-1 *</label>
                <input type="tel" name="mobile1" maxlength="10" class="form-control" placeholder="Mobile-1" pattern="[0-9]{10}" required>
              </div>
                        </div>
                        <div class="col-md-2">
                        <div class="form-group">
                <label for="">Mobile-2 </label>
                <input type="tel" name="mobile2" maxlength="10" class="form-control" placeholder="Mobile-2" pattern="[0-9]{10}">
              </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                <label for="">Address </label>
                <input type="text" name="address" class="form-control" placeholder="Address">
              </div>
</div>
                        <div class="col-md-5">
                        <div class="form-group">
                <label for="">Detail Bus/Car </label>
                <input type="text" name="vehicle_detail" class="form-control" placeholder="Bus/Car detail">
              </div>
</div>
                        <div class="form-group">
                </br>
                <button type="submit" name="travel_agency" class="btn btn-primary">Save</button>                </div>
                <div class="form-group">
                </br>&nbsp;
                        <button type="reset" class="btn btn-danger">Reset</button>
                </div>
                        </div>
                </div>
                
                </form>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th style="text-align:center">No.</th>
                                        <th style="text-align:center">TRAVEL AGENCY NAME</th>
                                        <th style="text-align:center">OWNER NAME</th>
                                        <th style="text-align:center">Mobile</th>
                                        <th style="text-align:center">Mobile</th>
                                        <th style="text-align:center">Address</th>
                                        <th style="text-align:center">BUS/ CAR DETAIL</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = " SELECT * FROM travel_agency";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                       
                    ?>           
                  <tr>
                    <td class="t_id">
                        <?php echo $row['t_id']; ?>
                      </td>
                    
                    <td>
                      
                    <?php echo $row['agency_name']; ?>
                    </td>
                    
                    <td>
                      <?php echo $row['owner_name']; ?>
                    </td>
                    <td>
                      <?php echo $row['mobile1']; ?>
                    </td>
                    <td>
                      <?php echo $row['mobile2']; ?>
                    </td>
                    <td>
                      <?php echo $row['address']; ?>
                    </td>
                   
                    <td>
                      <?php echo $row['vehicle_detail']; ?>
                    </td>
                    <td>
                    <a href="#" class="badge badge-primary part_view_btn"><i class="fa fa-eye"></i></a> &nbsp;|
                    <a href="#" class="badge badge-info part_edit_btn"><i class="fa fa-edit"></i></a>&nbsp;|
                          <a href="#" class="badge badge-danger agency_delete_btn"><i class="fa fa-trash-alt"></i></a>
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
                    <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
    </div>
                </section>
</div>

<?php
include('includes/footer.php');
?>
    <?php include('includes/script.php'); ?>

<script>
  $(document).ready(function () {

    $(document).on ("click",".agency_delete_btn",function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.t_id').text();
      //console.log(id);
      $('#t_id').val(id);
      $('#deleteAgencyModal').modal('show');
    });

    $(document).on ("click",".part_edit_btn",function (e) {
      e.preventDefault();
      var id = $(this).closest('tr').find('.p_id').text();
       //console.log(id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_part_btn': true,
          'part_id': id,
        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
            $('#edit_p_id').val(value['p_id']);
            $('#edit_vehicle_id').val(value['vehicle_id']);
            $('#edit_p_buy_date').val(value['p_buy_date']);
            $('#edit_p_part').val(value['p_part']);
            $('#edit_p_quantity').val(value['p_quantity']);
            $('#edit_p_vendor').val(value['p_vendor']);
            $('#edit_p_bill_no').val(value['p_bill_no']);
            $('#edit_oldbill_doc').val(value['p_bill_doc']);
            $('#edit_p_warranty_dt').val(value['p_warranty_dt']);
            $('#edit_p_price').val(value['p_price']);
            $('#edit_p_odm').val(value['p_odm']);
            $('#edit_p_total_amount').val(value['p_total_amount']);
            $('#edit_p_status').val(value['p_status']);
            $('#edit_p_due_amount').val(value['p_due_amount']);
            $('#edit_p_payment_dt').val(value['p_payment_dt']);
            $('#edit_p_comment').val(value['p_comment']);

          });

          $('#editPartModal').modal('show');
        }

      });

    });

    
  });

  </script>