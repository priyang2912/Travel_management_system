<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<!-- View Modal -->
<div class="modal fade" id="mainVIEWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Maintenance Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="main_viewing_data">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--View Modal end -->
<!-- Delete Modal start -->
<div class="modal fade" id="deleteMaintananceModal" tabindex="-1" role="dialog" aria-labelledby="deleteMaintananceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteMaintanaceModalLabel">Maintenace Data Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="m_id" id="m_id">
            <h4>Are you sure, You want to delete this Data ?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="main_delete_btn" class="btn btn-danger">Yes.! Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Delete End modal-->
   <!-- Edit Modal -->
   <div class="modal fade" id="editMainModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editMainModalLabel">Maintenace Details Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="database.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
          
            <div class="row">
              <input type="hidden" name="m_id" id="edit_m_id" value="" readonly>
              <div class="col-sm-6 col-md-3">
              <label class="form-label">Vechicle<span class="form-required">*</span></label>
              <div class="form-group">
                <select id="edit_m_vehicle" class="form-control selectized" name="m_vehicle" required="true">
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
            <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Repair Date *</label>
                                <input type="date" name="rep_date" id="edit_rep_date" class="form-control" required>
                            </div>
                        </div>
            
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Material</label>
                                <input type="text" name="material" id="edit_material" maxlength="100" class="form-control"
                                    placeholder="Material Name" />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" name="qut" id="edit_qut" max="90" min="0"
                                    class="form-control" placeholder="1" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Store/vendor Name</label>
                                <input type="text" name="vendor" id="edit_vendor" maxlength="70" class="form-control"
                                    placeholder="Vendor Name" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Description *</label>
                                <input type="text" name="part" maxlength="100" id="edit_part"
                                    class="form-control" placeholder="Service Description" >
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mechanic Name *</label>
                                <input type="text" name="mechanic" maxlength="70" id="edit_mechanic" class="form-control"
                                    placeholder="Mechanic Name" required />
                            </div>
                        </div>
                                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Labor Charge *</label>
                                <input type="text" name="charge" id="edit_charge" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="^[0-9]+\.?[0-9]{0,2}$" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Bill No</label>
                                <input type="text" name="bill_no" id="edit_bill_no" maxlength="60"
                                    class="form-control" placeholder="Bill NO" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Material Price</label>
                                <input type="text" name="material_price" id="edit_material_price" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="^[0-9]+\.?[0-9]{0,2}$">
                            </div>
                        </div>
                   
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Total Amount *</label>
                                <input type="text" name="total_amount" id="edit_total_amount" maxlength="8" min="0" class="form-control"
                                    placeholder="10,000.00" pattern="^[0-9]+\.?[0-9]{0,2}$" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-label">Upload Bill</label>
                        <input type="hidden" name="edit_oldbill_doc" id="edit_oldbill_doc">
                        <input type="file" name="m_bill_doc" id="m_bill_doc" class="form-control" placeholder="Upload Bill" >
                      </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Odometer</label>
                                <input type="tel" name="odm" id="edit_odm" maxlength="8" min="0" class="form-control"
                                    placeholder="455678">
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="">Payment</label></br>
                <select id="edit_m_status" name="m_status"  class="form-control" required="true">
                <option value="" selected disabled hidden>Select</option>
                  <option value="0">Paid</option>
                  <option value="1">Due Payment</option>
                </select>
              </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="p_due_amount">Due Payment</label>
                                <input type="text" name="m_due_amount" id="edit_m_due_amount" maxlength="8" min="0" class="form-control"
                                    placeholder="1000.00"pattern="^[0-9]+\.?[0-9]{0,2}$">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Payment Date *</label>
                                <input type="date" name="pay_date" id="edit_pay_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Comments</label>
                                <input type="text" name="comment" id="edit_comment" maxlength="200" class="form-control"
                                    placeholder="any">
                            </div>
                        </div>
          </div>
          <div class="modal-footer">
          <input type="reset" value="Reset" class="btn btn-danger" />
            <button type="submit" class="btn btn-primary" name="main_update_btn">Update </button>
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
                    <h3 class="m-0 text-dark">Maintenance Data</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Maintenace List</li>
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
              <strong>Maintanance</strong>
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
              <strong>Maintanance</strong>
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Spare Parts Detail</h3>
                        <a href="maintanance_add.php" class="btn btn-outline-info float-right">Maintanace Add</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th hidden>Id.</th>
                                    <th>S.No</th>
                                    <th>Vehicle</th>
                                    <th>Repair Date</th>
                                    <th>Description</th>
                                    <th>Labour</th>
                                    <th>Material Price</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                    
                    $query = "SELECT * FROM maintanance";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      $count=1;
                      foreach ($query_run as $row) {
                        //echo $row['name'];
                        $id = $row['m_vehicle'];
                        $sql = "SELECT reg_no FROM vehicle WHERE id='$id'";
                        $res = mysqli_query($con,$sql);
                        $fetch = mysqli_fetch_assoc($res);
                    ?>           
                  <tr>
                    <td class="m_id" hidden>
                        <?php echo $row['m_id']; ?>
                      </td>
                      <td><?php echo $count; $count++;?></td>

                    <td>
                      
                    <?php echo $fetch['reg_no']; ?>
                    </td>
                    <td>
                      <?php
                      $booking_dt = date("d-m-Y", strtotime($row['m_repair_dt']));
                      echo $booking_dt; ?>
                    </td>
                    <td>
                      <?php echo $row['m_description']; ?>
                    </td>
                    <td>
                      <?php echo $row['m_labour_charge']; ?>
                    </td>
                    <td>
                      <?php echo $row['m_material_price']; ?>
                    </td>
                    <td>
                      <?php echo $row['m_total_amount']; ?>
                    </td>
                    <td>
                    <?php 
                      if($row['m_status']=="0"){
                        echo "<span class='badge badge-success'>PAID</span>";
                      }elseif($row['m_status']=="1"){
                        echo "<span class='badge badge-warning'>DUE PAYMENT</span>";
                      } ?>
                    </td>
                    <td>
                      <?php echo $row['m_due_payment']; ?>
                    </td>
                    <td>
                    <a href="#" class="badge badge-primary main_view_btn"><i class="fa fa-eye"></i></a> &nbsp;|
                    <a href="#" class="badge badge-info main_edit_btn"><i class="fa fa-edit"></i></a>&nbsp;|
                          <a href="#" class="badge badge-danger main_delete_btn"><i class="fa fa-trash-alt"></i></a>
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

<?php
include('includes/footer.php');
?>
    <?php include('includes/script.php'); ?>

<script>
  $(document).ready(function () {

    $(document).on ("click",".main_delete_btn",function (e) {
      e.preventDefault();

      var id = $(this).closest('tr').find('.m_id').text();
      //console.log(id);
      $('#m_id').val(id);
      $('#deleteMaintananceModal').modal('show');
    });

    $(document).on ("click",".main_edit_btn",function (e) {
      e.preventDefault();
      var id = $(this).closest('tr').find('.m_id').text();
       //console.log(id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_main_btn': true,
          'main_id': id,
        },
        success: function (response) {
          //console.log(response);
          $.each(response, function (key, value) {
            $('#edit_m_id').val(value['m_id']);
            $('#edit_m_vehicle').val(value['m_vehicle']);
            $('#edit_rep_date').val(value['m_repair_dt']);
            $('#edit_material').val(value['m_material']);
            $('#edit_qut').val(value['m_quantity']);
            $('#edit_vendor').val(value['m_vendor']);
            $('#edit_part').val(value['m_description']);
            $('#edit_mechanic').val(value['m_mechanic']);
            $('#edit_charge').val(value['m_labour_charge']);
            $('#edit_bill_no').val(value['m_bill_no']);
            $('#edit_material_price').val(value['m_material_price']);
            $('#edit_total_amount').val(value['m_total_amount']);
            $('#edit_oldbill_doc').val(value['m_bill_doc']);
            $('#edit_odm').val(value['m_odm']);
            $('#edit_m_status').val(value['m_status']);
            $('#edit_m_due_amount').val(value['m_due_payment']);
            $('#edit_pay_date').val(value['m_payment_dt']);
            $('#edit_comment').val(value['m_comment']);

          });

          $('#editMainModal').modal('show');
        }

      });

    });

    $(document).on ("click",".main_view_btn",function (e) {
      e.preventDefault();
      var id = $(this).closest('tr').find('.m_id').text();
      //console.log(d_id);
      //alert('hello');

      $.ajax({
        type: "POST",
        url: "database.php",
        data: {
          'checking_mainviewbtn': true,
          'main_id': id,
        },
        success: function (response) {
          //console.log(response);
          $('.main_viewing_data').html(response);
          $('#mainVIEWModal').modal('show');
        }

      });
    
    });
  });

  </script> 